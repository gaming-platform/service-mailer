<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application\Command;

final class RemoveTemplateCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * RemoveTemplateCommand constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
