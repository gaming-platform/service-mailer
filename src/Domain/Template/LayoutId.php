<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\LayoutNotFoundException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class LayoutId
{
    /**
     * @var UuidInterface
     */
    private $layoutId;

    /**
     * LayoutId constructor.
     *
     * @param UuidInterface $uuid
     *
     * @throws LayoutNotFoundException
     */
    private function __construct(UuidInterface $uuid)
    {
        $this->layoutId = $uuid;

        // Only Uuid version 1 is a valid LayoutId.
        if ($uuid->getVersion() !== 1) {
            throw new LayoutNotFoundException();
        }
    }

    /**
     * @return LayoutId
     */
    public static function generate(): LayoutId
    {
        return new self(Uuid::uuid1());
    }

    /**
     * Create an LayoutId from string.
     *
     * @param string $layoutId
     *
     * @return LayoutId
     * @throws LayoutNotFoundException
     */
    public static function fromString(string $layoutId): LayoutId
    {
        try {
            return new self(Uuid::fromString($layoutId));
        } catch (\Exception $exception) {
            // This occurs if the given string is an invalid Uuid, hence an invalid LayoutId.
            // Throw exception, that the layout can't be found.
            throw new LayoutNotFoundException();
        }
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->layoutId->toString();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
