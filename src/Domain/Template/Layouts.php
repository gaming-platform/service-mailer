<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Domain\Template;

use GamingPlatform\Mailer\Domain\Template\Exception\LayoutNotFoundException;

interface Layouts
{
    /**
     * Get the next identity.
     *
     * @return LayoutId
     */
    public function nextIdentity(): LayoutId;

    /**
     * Save a layout.
     *
     * @param Layout $layout
     */
    public function save(Layout $layout): void;

    /**
     * Remove all layouts.
     */
    public function removeAll(): void;

    /**
     * Get a layout by name.
     *
     * @param string $name
     *
     * @return Layout
     * @throws LayoutNotFoundException
     */
    public function latestByName(string $name): Layout;
}
