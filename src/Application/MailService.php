<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application;

use GamingPlatform\Mailer\Application\Command\DeliverMailCommand;
use GamingPlatform\Mailer\Domain\Mail\Exception\DeliverFailedException;
use GamingPlatform\Mailer\Domain\Mail\Mail;
use GamingPlatform\Mailer\Domain\Mail\Postman;
use GamingPlatform\Mailer\Domain\Participant;
use GamingPlatform\Mailer\Domain\Template\Engine;
use GamingPlatform\Mailer\Domain\Template\Exception\RenderFailedException;
use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;
use GamingPlatform\Mailer\Domain\Template\Layouts;
use GamingPlatform\Mailer\Domain\Template\Templates;

final class MailService
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
     * @param Layouts   $layouts
     * @param Templates $templates
     * @param Engine    $templateEngine
     * @param Postman   $postman
     */
    public function __construct(Layouts $layouts, Templates $templates, Engine $templateEngine, Postman $postman)
    {
        $this->layouts = $layouts;
        $this->templates = $templates;
        $this->templateEngine = $templateEngine;
        $this->postman = $postman;
    }

    /**
     * Deliver an email.
     *
     * @param DeliverMailCommand $deliverMailCommand
     *
     * @throws DeliverFailedException
     * @throws RenderFailedException
     * @throws TemplateNotFoundException
     */
    public function deliver(DeliverMailCommand $deliverMailCommand): void
    {
        $template = $this->templates->latestRevisionByName($deliverMailCommand->templateName());
        $layout = $this->layouts->latestByName($template->layoutName());

        $htmlTemplate = $layout->wrapHtml($template->htmlTemplate());
        $textTemplate = $layout->wrapText($template->textTemplate());

        $mail = new Mail(
            $template->sender(),
            new Participant($deliverMailCommand->receiverEmail(), $deliverMailCommand->receiverName()),
            $this->templateEngine->renderText($template->subjectTemplate(), $deliverMailCommand->templateParameters()),
            $this->templateEngine->renderHtml($htmlTemplate, $deliverMailCommand->templateParameters()),
            $this->templateEngine->renderText($textTemplate, $deliverMailCommand->templateParameters())
        );

        $this->postman->deliver($mail);
    }
}
