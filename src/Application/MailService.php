<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application;

use GamingPlatform\Mailer\Application\Command\ScheduleMailCommand;
use GamingPlatform\Mailer\Domain\Template\Engine;
use GamingPlatform\Mailer\Domain\Template\Templates;

final class MailService
{
    /**
     * @var Templates
     */
    private $templates;

    /**
     * @var Engine
     */
    private $templateEngine;

    /**
     * MailService constructor.
     *
     * @param Templates $templates
     * @param Engine    $templateEngine
     */
    public function __construct(Templates $templates, Engine $templateEngine)
    {
        $this->templates = $templates;
        $this->templateEngine = $templateEngine;
    }

    public function schedule(ScheduleMailCommand $scheduleMailCommand): void
    {
        $template = $this->templates->byName($scheduleMailCommand->templateName());

        dump($this->templateEngine->render($template->subjectTemplate(), $scheduleMailCommand->templateParameters()));
        dump($this->templateEngine->render($template->htmlTemplate(), $scheduleMailCommand->templateParameters()));
        dump($this->templateEngine->render($template->textTemplate(), $scheduleMailCommand->templateParameters()));

        // todo
    }
}
