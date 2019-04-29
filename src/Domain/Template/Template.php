<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Participant;

/**
 * @final Can not be set due doctrine.
 */
class Template
{
    /**
     * @var TemplateId
     */
    private $templateId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Participant
     */
    private $sender;

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
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * Template constructor.
     *
     * @param TemplateId         $templateId
     * @param string             $name
     * @param Participant        $sender
     * @param string             $subjectTemplate
     * @param string             $htmlTemplate
     * @param string             $textTemplate
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(
        TemplateId $templateId,
        string $name,
        Participant $sender,
        string $subjectTemplate,
        string $htmlTemplate,
        string $textTemplate,
        \DateTimeImmutable $createdAt
    ) {
        $this->templateId = $templateId;
        $this->name = $name;
        $this->sender = $sender;
        $this->subjectTemplate = $subjectTemplate;
        $this->htmlTemplate = $htmlTemplate;
        $this->textTemplate = $textTemplate;
        $this->createdAt = $createdAt;
    }

    /**
     * @return TemplateId
     */
    public function id(): TemplateId
    {
        return $this->templateId;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return Participant
     */
    public function sender(): Participant
    {
        return $this->sender;
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

    /**
     * @return \DateTimeImmutable
     */
    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
