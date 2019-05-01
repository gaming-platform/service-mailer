<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Postman;

use GamingPlatform\Mailer\Domain\Mail\Exception\DeliverFailedException;
use GamingPlatform\Mailer\Domain\Mail\Mail;
use GamingPlatform\Mailer\Domain\Mail\Postman;

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
    public function deliver(Mail $mail): void
    {
        try {
            $this->swiftMailer->send(
                (new \Swift_Message())
                    ->setFrom($mail->sender()->email(), $mail->sender()->name())
                    ->setTo($mail->receiver()->email(), $mail->receiver()->name())
                    ->setSubject($mail->subject())
                    ->setBody($mail->htmlPart(), 'text/html')
                    ->addPart($mail->textPart(), 'text/plain')
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
