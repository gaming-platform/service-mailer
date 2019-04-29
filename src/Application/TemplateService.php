<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application;

use GamingPlatform\Mailer\Application\Command\NewTemplateRevisionCommand;
use GamingPlatform\Mailer\Domain\Participant;
use GamingPlatform\Mailer\Domain\Template\Template;
use GamingPlatform\Mailer\Domain\Template\Templates;

final class TemplateService
{
    /**
     * @var Templates
     */
    private $templates;

    /**
     * TemplateService constructor.
     *
     * @param Templates $templates
     */
    public function __construct(Templates $templates)
    {
        $this->templates = $templates;
    }

    /**
     * Add a new template revision.
     *
     * @param NewTemplateRevisionCommand $newTemplateRevisionCommand
     *
     * @throws \Exception
     */
    public function newTemplateRevision(NewTemplateRevisionCommand $newTemplateRevisionCommand): void
    {
        $template = new Template(
            $this->templates->nextIdentity(),
            $newTemplateRevisionCommand->name(),
            new Participant($newTemplateRevisionCommand->senderEmail(), $newTemplateRevisionCommand->senderName()),
            $newTemplateRevisionCommand->subjectTemplate(),
            $newTemplateRevisionCommand->htmlTemplate(),
            $newTemplateRevisionCommand->textTemplate(),
            new \DateTimeImmutable()
        );

        $this->templates->save($template);
    }
}
