<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain;

final class Participant
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * Participant constructor.
     *
     * @param string $email
     * @param string $name
     */
    public function __construct(string $email, string $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
