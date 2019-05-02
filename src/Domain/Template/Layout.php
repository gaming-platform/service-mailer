<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

/**
 * @final Can not be set due doctrine.
 */
class Layout
{
    /**
     * @var LayoutId
     */
    private $layoutId;

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
     * @var \DateTimeImmutable
     */
    private $createdAt;

    /**
     * Layout constructor.
     *
     * @param LayoutId           $layoutId
     * @param string             $name
     * @param string             $placeholderIdentifier
     * @param string             $htmlTemplate
     * @param string             $textTemplate
     * @param \DateTimeImmutable $createdAt
     */
    public function __construct(
        LayoutId $layoutId,
        string $name,
        string $placeholderIdentifier,
        string $htmlTemplate,
        string $textTemplate,
        \DateTimeImmutable $createdAt
    ) {
        $this->layoutId = $layoutId;
        $this->name = $name;
        $this->placeholderIdentifier = $placeholderIdentifier;
        $this->htmlTemplate = $htmlTemplate;
        $this->textTemplate = $textTemplate;
        $this->createdAt = $createdAt;
    }

    /**
     * @return LayoutId
     */
    public function id(): LayoutId
    {
        return $this->layoutId;
    }

    /**
     * Wrap the given html.
     *
     * @param string $html
     *
     * @return string
     */
    public function wrapHtml(string $html): string
    {
        return str_replace(
            $this->placeholderIdentifier,
            $html,
            $this->htmlTemplate
        );
    }

    /**
     * Wrap the given text.
     *
     * @param string $text
     *
     * @return string
     */
    public function wrapText(string $text): string
    {
        return str_replace(
            $this->placeholderIdentifier,
            $text,
            $this->textTemplate
        );
    }
}
