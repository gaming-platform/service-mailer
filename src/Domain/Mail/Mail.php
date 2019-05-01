<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Mail;

use GamingPlatform\Mailer\Domain\Participant;

final class Mail
{
    /**
     * @var Participant
     */
    private $sender;

    /**
     * @var Participant
     */
    private $receiver;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $htmlPart;

    /**
     * @var string
     */
    private $textPart;

    /**
     * Mail constructor.
     *
     * @param Participant $sender
     * @param Participant $receiver
     * @param string      $subject
     * @param string      $htmlPart
     * @param string      $textPart
     */
    public function __construct(
        Participant $sender,
        Participant $receiver,
        string $subject,
        string $htmlPart,
        string $textPart
    ) {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->subject = $subject;
        $this->htmlPart = $htmlPart;
        $this->textPart = $textPart;
    }

    /**
     * @return Participant
     */
    public function sender(): Participant
    {
        return $this->sender;
    }

    /**
     * @return Participant
     */
    public function receiver(): Participant
    {
        return $this->receiver;
    }

    /**
     * @return string
     */
    public function subject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function htmlPart(): string
    {
        return $this->htmlPart;
    }

    /**
     * @return string
     */
    public function textPart(): string
    {
        return $this->textPart;
    }
}
