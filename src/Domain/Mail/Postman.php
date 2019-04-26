<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Mail;

use GamingPlatform\Mailer\Domain\Mail\Exception\DeliverFailedException;
use GamingPlatform\Mailer\Domain\Participant;

interface Postman
{
    /**
     * Deliver a mail.
     *
     * @param Participant $sender
     * @param Participant $receiver
     * @param string      $subject
     * @param string      $htmlPart
     * @param string      $textPart
     *
     * @throws DeliverFailedException
     */
    public function deliver(
        Participant $sender,
        Participant $receiver,
        string $subject,
        string $htmlPart,
        string $textPart
    ): void;
}
