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
     * Remove all templates.
     */
    public function removeAll(): void;

    /**
     * Get a template by name.
     *
     * @param string $name
     *
     * @return Template
     * @throws TemplateNotFoundException
     */
    public function latestByName(string $name): Template;
}
