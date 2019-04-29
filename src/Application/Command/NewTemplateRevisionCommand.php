<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application\Command;

final class NewTemplateRevisionCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $senderEmail;

    /**
     * @var string
     */
    private $senderName;

    /**
     * @var string
     */
    private $subjectTemplate;

    /**
     * @var string
     */
    private $htmlTemplate;

    /**
     * @var string
     */
    private $textTemplate;

    /**
     * NewTemplateRevisionCommand constructor.
     *
     * @param string $name
     * @param string $senderEmail
     * @param string $senderName
     * @param string $subjectTemplate
     * @param string $htmlTemplate
     * @param string $textTemplate
     */
    public function __construct(
        string $name,
        string $senderEmail,
        string $senderName,
        string $subjectTemplate,
        string $htmlTemplate,
        string $textTemplate
    ) {
        $this->name = $name;
        $this->senderEmail = $senderEmail;
        $this->senderName = $senderName;
        $this->subjectTemplate = $subjectTemplate;
        $this->htmlTemplate = $htmlTemplate;
        $this->textTemplate = $textTemplate;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function senderEmail(): string
    {
        return $this->senderEmail;
    }

    /**
     * @return string
     */
    public function senderName(): string
    {
        return $this->senderName;
    }

    /**
     * @return string
     */
    public function subjectTemplate(): string
    {
        return $this->subjectTemplate;
    }

    /**
     * @return string
     */
    public function htmlTemplate(): string
    {
        return $this->htmlTemplate;
    }

    /**
     * @return string
     */
    public function textTemplate(): string
    {
        return $this->textTemplate;
    }
}
