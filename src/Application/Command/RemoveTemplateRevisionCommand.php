<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application\Command;

final class RemoveTemplateRevisionCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $revisionId;

    /**
     * RemoveTemplateRevisionCommand constructor.
     *
     * @param string $name
     * @param string $revisionId
     */
    public function __construct(string $name, string $revisionId)
    {
        $this->name = $name;
        $this->revisionId = $revisionId;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function revisionId(): string
    {
        return $this->revisionId;
    }
}
