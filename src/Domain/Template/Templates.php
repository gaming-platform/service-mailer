<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;

interface Templates
{
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
