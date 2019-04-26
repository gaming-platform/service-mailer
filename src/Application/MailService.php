<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application;

use GamingPlatform\Mailer\Application\Command\ScheduleMailCommand;
use GamingPlatform\Mailer\Domain\Template\Engine;

final class MailService
{
    /**
     * @var Engine
     */
    private $templateEngine;

    /**
     * MailService constructor.
     *
     * @param Engine $templateEngine
     */
    public function __construct(Engine $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function schedule(ScheduleMailCommand $scheduleMailCommand): void
    {
        // todo
    }
}
