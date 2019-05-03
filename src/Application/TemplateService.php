<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application;

use GamingPlatform\Mailer\Application\Command\NewLayoutRevisionCommand;
use GamingPlatform\Mailer\Application\Command\NewTemplateRevisionCommand;
use GamingPlatform\Mailer\Application\Command\RemoveTemplateRevisionCommand;
use GamingPlatform\Mailer\Domain\Participant;
use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;
use GamingPlatform\Mailer\Domain\Template\Layout;
use GamingPlatform\Mailer\Domain\Template\Layouts;
use GamingPlatform\Mailer\Domain\Template\Template;
use GamingPlatform\Mailer\Domain\Template\TemplateId;
use GamingPlatform\Mailer\Domain\Template\Templates;

final class TemplateService
{
    /**
     * @var Layouts
     */
    private $layouts;

    /**
     * @var Templates
     */
    private $templates;

    /**
     * TemplateService constructor.
     *
     * @param Layouts   $layouts
     * @param Templates $templates
     */
    public function __construct(Layouts $layouts, Templates $templates)
    {
        $this->layouts = $layouts;
        $this->templates = $templates;
    }

    /**
     * Add a new layout revision.
     *
     * @param NewLayoutRevisionCommand $newLayoutRevisionCommand
     *
     * @throws \Exception
     */
    public function newLayoutRevision(NewLayoutRevisionCommand $newLayoutRevisionCommand): void
    {
        $layout = new Layout(
            $this->layouts->nextIdentity(),
            $newLayoutRevisionCommand->name(),
            $newLayoutRevisionCommand->placeholderIdentifier(),
            $newLayoutRevisionCommand->htmlTemplate(),
            $newLayoutRevisionCommand->textTemplate(),
            new \DateTimeImmutable()
        );

        $this->layouts->save($layout);
    }

    /**
     * Remove all layouts.
     */
    public function removeAllLayouts(): void
    {
        $this->layouts->removeAll();
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
            $newTemplateRevisionCommand->layoutName(),
            new Participant($newTemplateRevisionCommand->senderEmail(), $newTemplateRevisionCommand->senderName()),
            $newTemplateRevisionCommand->subjectTemplate(),
            $newTemplateRevisionCommand->htmlTemplate(),
            $newTemplateRevisionCommand->textTemplate(),
            new \DateTimeImmutable()
        );

        $this->templates->save($template);
    }

    /**
     * Remove a template revision.
     *
     * @param RemoveTemplateRevisionCommand $removeTemplateRevisionCommand
     *
     * @throws TemplateNotFoundException
     */
    public function removeTemplateRevision(RemoveTemplateRevisionCommand $removeTemplateRevisionCommand): void
    {
        $this->templates->removeRevision(
            $removeTemplateRevisionCommand->name(),
            TemplateId::fromString($removeTemplateRevisionCommand->revisionId())
        );
    }

    /**
     * Remove all templates.
     */
    public function removeAllTemplates(): void
    {
        $this->templates->removeAll();
    }
}
