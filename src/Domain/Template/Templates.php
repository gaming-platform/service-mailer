<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;

interface Templates
{
    /**
     * Get the next identity.
     *
     * @return TemplateId
     */
    public function nextIdentity(): TemplateId;

    /**
     * Save a template.
     *
     * @param Template $template
     */
    public function save(Template $template): void;

    /**
     * Remove a template.
     *
     * @param string $name
     *
     * @throws TemplateNotFoundException
     */
    public function remove(string $name): void;

    /**
     * Remove a template revision.
     *
     * @param string     $name
     * @param TemplateId $templateId
     *
     * @throws TemplateNotFoundException
     */
    public function removeRevision(string $name, TemplateId $templateId): void;

    /**
     * Remove all templates.
     */
    public function removeAll(): void;

    /**
     * Get the latest template revision by name.
     *
     * @param string $name
     *
     * @return Template
     * @throws TemplateNotFoundException
     */
    public function latestRevisionByName(string $name): Template;
}
