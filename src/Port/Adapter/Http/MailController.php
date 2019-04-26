<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class MailController
{
    public function scheduleAction(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'success' => true
            ]
        );
    }
}
