<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Participant;

final class Template
{
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
     * Template constructor.
     *
     * @param string $name
     * @param Participant $sender
     * @param string $subjectTemplate
     * @param string $htmlTemplate
     * @param string $textTemplate
     */
    public function __construct(
        string $name,
        Participant $sender,
        string $subjectTemplate,
        string $htmlTemplate,
        string $textTemplate
    ) {
        $this->name = $name;
        $this->sender = $sender;
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
}
