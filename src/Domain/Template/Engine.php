<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\RenderFailedException;

interface Engine
{
    /**
     * Render the template with its parameters.
     *
     * @param string $template
     * @param array  $parameters
     *
     * @return string
     * @throws RenderFailedException
     */
    public function render(string $template, array $parameters): string;
}
