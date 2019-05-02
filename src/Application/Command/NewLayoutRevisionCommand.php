<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Application\Command;

final class NewLayoutRevisionCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $placeholderIdentifier;

    /**
     * @var string
     */
    private $htmlTemplate;

    /**
     * @var string
     */
    private $textTemplate;

    /**
     * NewLayoutRevisionCommand constructor.
     *
     * @param string $name
     * @param string $placeholderIdentifier
     * @param string $htmlTemplate
     * @param string $textTemplate
     */
    public function __construct(string $name, string $placeholderIdentifier, string $htmlTemplate, string $textTemplate)
    {
        $this->name = $name;
        $this->placeholderIdentifier = $placeholderIdentifier;
        $this->htmlTemplate = $htmlTemplate;
        $this->textTemplate = $textTemplate;
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
    public function placeholderIdentifier(): string
    {
        return $this->placeholderIdentifier;
    }

    /**
     * @return string
     */
    public function htmlTemplate(): string
    {
        return $this->htmlTemplate;
    }

    /**
     * @return string
     */
    public function textTemplate(): string
    {
        return $this->textTemplate;
    }
}
