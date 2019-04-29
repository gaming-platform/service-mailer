<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application\Command;

final class DeliverMailCommand
{
    /**
     * @var string
     */
    private $receiverEmail;

    /**
     * @var string
     */
    private $receiverName;

    /**
     * @var string
     */
    private $templateName;

    /**
     * @var array
     */
    private $templateParameters;

    /**
     * DeliverMailCommand constructor.
     *
     * @param string $receiverEmail
     * @param string $receiverName
     * @param string $templateName
     * @param array  $templateParameters
     */
    public function __construct(
        string $receiverEmail,
        string $receiverName,
        string $templateName,
        array $templateParameters
    ) {
        $this->receiverEmail = $receiverEmail;
        $this->receiverName = $receiverName;
        $this->templateName = $templateName;
        $this->templateParameters = $templateParameters;
    }

    /**
     * @return string
     */
    public function receiverEmail(): string
    {
        return $this->receiverEmail;
    }

    /**
     * @return string
     */
    public function receiverName(): string
    {
        return $this->receiverName;
    }

    /**
     * @return string
     */
    public function templateName(): string
    {
        return $this->templateName;
    }

    /**
     * @return array
     */
    public function templateParameters(): array
    {
        return $this->templateParameters;
    }
}
