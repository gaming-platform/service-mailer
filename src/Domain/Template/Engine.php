<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\RenderFailedException;

interface Engine
{
    /**
     * Render the html template with its parameters.
     *
     * @param string $template
     * @param array  $parameters
     *
     * @return string
     * @throws RenderFailedException
     */
    public function renderHtml(string $template, array $parameters): string;

    /**
     * Render the text template with its parameters.
     *
     * @param string $template
     * @param array  $parameters
     *
     * @return string
     * @throws RenderFailedException
     */
    public function renderText(string $template, array $parameters): string;
}
