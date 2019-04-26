<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Postman;

use GamingPlatform\Mailer\Domain\Mail\Exception\DeliverFailedException;
use GamingPlatform\Mailer\Domain\Mail\Postman;
use GamingPlatform\Mailer\Domain\Participant;

final class SwiftMailerPostman implements Postman
{
    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * SwiftMailerPostman constructor.
     *
     * @param \Swift_Mailer $swiftMailer
     */
    public function __construct(\Swift_Mailer $swiftMailer)
    {
        $this->swiftMailer = $swiftMailer;
    }

    /**
     * @inheritdoc
     */
    public function deliver(
        Participant $sender,
        Participant $receiver,
        string $subject,
        string $htmlPart,
        string $textPart
    ): void {
        try {
            $this->swiftMailer->send(
                (new \Swift_Message())
                    ->setFrom($sender->email(), $sender->name())
                    ->setTo($receiver->email(), $receiver->name())
                    ->setSubject($subject)
                    ->setBody($htmlPart, 'text/html')
                    ->addPart($textPart, 'text/plain')
            );
        } catch (\Throwable $e) {
            throw new DeliverFailedException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
