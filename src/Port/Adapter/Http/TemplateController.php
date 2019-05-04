<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Http;

use GamingPlatform\Mailer\Application\Command\RemoveTemplateCommand;
use GamingPlatform\Mailer\Application\Command\RemoveTemplateRevisionCommand;
use GamingPlatform\Mailer\Application\TemplateService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TemplateController
{
    /**
     * @var TemplateService
     */
    private $templateService;

    /**
     * TemplateController constructor.
     *
     * @param TemplateService $templateService
     */
    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * Remove a template.
     *
     * @param string $name
     *
     * @return JsonResponse
     */
    public function removeTemplateAction(string $name): JsonResponse
    {
        $this->templateService->removeTemplate(
            new RemoveTemplateCommand(
                $name
            )
        );

        return new JsonResponse(
            [
                'success' => true
            ]
        );
    }

    /**
     * Remove a template revision.
     *
     * @param string $name
     * @param string $revisionId
     *
     * @return JsonResponse
     */
    public function removeTemplateRevisionAction(string $name, string $revisionId): JsonResponse
    {
        $this->templateService->removeTemplateRevision(
            new RemoveTemplateRevisionCommand(
                $name,
                $revisionId
            )
        );

        return new JsonResponse(
            [
                'success' => true
            ]
        );
    }
}
