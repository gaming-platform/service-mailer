<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Console;

use GamingPlatform\Mailer\Application\Command\NewTemplateRevisionCommand;
use GamingPlatform\Mailer\Application\TemplateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

final class OverwriteWithImportCommand extends Command
{
    /**
     * @var TemplateService
     */
    private $templateService;

    /**
     * @var string
     */
    private $importDirectory;

    /**
     * LoadFixturesCommand constructor.
     *
     * @param TemplateService $templateService
     */
    public function __construct(TemplateService $templateService, string $importDirectory)
    {
        parent::__construct();

        $this->templateService = $templateService;
        $this->importDirectory = $importDirectory;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('project:overwrite-with-import')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Must be set.');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getOption('force')) {
            $output->writeln('Option "--force" must be set.');
            return;
        }

        $output->writeln('Import started.');

        $templateDirectory = $this->importDirectory . '/template';

        if (!is_dir($templateDirectory)) {
            $output->writeln('Skip import. Directory "' . $templateDirectory . '" does not exist.');
            return;
        }

        $templateFinder = (new Finder())
            ->in($templateDirectory)
            ->files();

        if ($templateFinder->count() === 0) {
            $output->writeln('Skip import. No files in "' . $templateDirectory . '".');
            return;
        }

        $this->templateService->removeAllTemplates();
        $output->writeln('Templates removed.');

        foreach ($templateFinder->getIterator() as $templateFile) {
            $template = json_decode($templateFile->getContents(), true);

            if ($template === null) {
                $output->writeln('Skip "' . $templateFile->getFilename() . '": ' . json_last_error_msg());
                continue;
            }

            try {
                $this->templateService->newTemplateRevision(
                    new NewTemplateRevisionCommand(
                        (string)($template['name'] ?? ''),
                        (string)($template['senderEmail'] ?? ''),
                        (string)($template['senderName'] ?? ''),
                        (string)($template['subjectTemplate'] ?? ''),
                        (string)($template['htmlTemplate'] ?? ''),
                        (string)($template['textTemplate'] ?? '')
                    )
                );

                $output->writeln('Successfully imported "' . $templateFile->getFilename() . '".');
            } catch (\Throwable $e) {
                $output->writeln('Error while importing "' . $templateFile->getFilename() . '".');
                $output->writeln('Error: ' . $e->getMessage());
            }
        }
    }
}
