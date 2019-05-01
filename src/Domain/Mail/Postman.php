<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Mail;

use GamingPlatform\Mailer\Domain\Mail\Exception\DeliverFailedException;

interface Postman
{
    /**
     * Deliver a mail.
     *
     * @param Mail $mail
     *
     * @throws DeliverFailedException
     */
    public function deliver(Mail $mail): void;
}
