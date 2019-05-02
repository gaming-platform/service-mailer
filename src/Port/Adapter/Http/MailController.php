<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Http;

use GamingPlatform\Mailer\Application\Command\DeliverMailCommand;
use GamingPlatform\Mailer\Application\MailService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class MailController
{
    /**
     * @var MailService
     */
    private $mailService;

    /**
     * MailController constructor.
     *
     * @param MailService $mailService
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Endpoint for deliver a mail.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deliverAction(Request $request): JsonResponse
    {
        $templateParameters = $request->request->get('templateParameters', []);

        $this->mailService->deliver(
            new DeliverMailCommand(
                $request->request->get('receiverEmail', ''),
                $request->request->get('receiverName', ''),
                $request->request->get('templateName', ''),
                is_array($templateParameters) ? $templateParameters : []
            )
        );

        return new JsonResponse(
            [
                'success' => true
            ]
        );
    }
}
