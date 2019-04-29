<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application;

use GamingPlatform\Mailer\Application\Command\ScheduleMailCommand;
use GamingPlatform\Mailer\Domain\Mail\Postman;
use GamingPlatform\Mailer\Domain\Participant;
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
     * @var Postman
     */
    private $postman;

    /**
     * MailService constructor.
     *
     * @param Templates $templates
     * @param Engine    $templateEngine
     * @param Postman   $postman
     */
    public function __construct(Templates $templates, Engine $templateEngine, Postman $postman)
    {
        $this->templates = $templates;
        $this->templateEngine = $templateEngine;
        $this->postman = $postman;
    }

    public function schedule(ScheduleMailCommand $scheduleMailCommand): void
    {
        $template = $this->templates->byName($scheduleMailCommand->templateName());

        $this->postman->deliver(
            $template->sender(),
            new Participant($scheduleMailCommand->receiverEmail(), $scheduleMailCommand->receiverName()),
            $this->templateEngine->renderText($template->subjectTemplate(), $scheduleMailCommand->templateParameters()),
            $this->templateEngine->renderHtml($template->htmlTemplate(), $scheduleMailCommand->templateParameters()),
            $this->templateEngine->renderText($template->textTemplate(), $scheduleMailCommand->templateParameters())
        );
    }
}
