<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\TemplateEngine;

use GamingPlatform\Mailer\Domain\Template\Engine;
use GamingPlatform\Mailer\Domain\Template\Exception\RenderFailedException;
use Twig\Environment;

final class TwigTemplateEngine implements Engine
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * TwigTemplateEngine constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @inheritdoc
     */
    public function render(string $template, array $parameters): string
    {
        try {
            return $this->twig->createTemplate($template)->render($parameters);
        } catch (\Throwable $e) {
            throw new RenderFailedException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
