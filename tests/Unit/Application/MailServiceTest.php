<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Tests\Application;

use GamingPlatform\Mailer\Application\MailService;
use PHPUnit\Framework\TestCase;

final class MailServiceTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldSchedule(): void
    {
        $mailService = new MailService();

        $mailService->schedule();

        $this->assertTrue(true);
    }
}
