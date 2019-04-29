<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TemplateId
{
    /**
     * @var UuidInterface
     */
    private $templateId;

    /**
     * TemplateId constructor.
     *
     * @param UuidInterface $uuid
     *
     * @throws TemplateNotFoundException
     */
    private function __construct(UuidInterface $uuid)
    {
        $this->templateId = $uuid;

        // Only Uuid version 1 is a valid TemplateId.
        if ($uuid->getVersion() !== 1) {
            throw new TemplateNotFoundException();
        }
    }

    /**
     * @return TemplateId
     */
    public static function generate(): TemplateId
    {
        return new self(Uuid::uuid1());
    }

    /**
     * Create an TemplateId from string.
     *
     * @param string $templateId
     *
     * @return TemplateId
     * @throws TemplateNotFoundException
     */
    public static function fromString(string $templateId): TemplateId
    {
        try {
            return new self(Uuid::fromString($templateId));
        } catch (\Exception $exception) {
            // This occurs if the given string is an invalid Uuid, hence an invalid TemplateId.
            // Throw exception, that the template can't be found.
            throw new TemplateNotFoundException();
        }
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->templateId->toString();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
