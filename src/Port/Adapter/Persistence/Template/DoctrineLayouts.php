<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Persistence\Template;

use Doctrine\ORM\EntityManager;
use GamingPlatform\Mailer\Domain\Template\Exception\LayoutNotFoundException;
use GamingPlatform\Mailer\Domain\Template\Layout;
use GamingPlatform\Mailer\Domain\Template\LayoutId;
use GamingPlatform\Mailer\Domain\Template\Layouts;

final class DoctrineLayouts implements Layouts
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * DoctrineLayouts constructor.
     *
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @inheritdoc
     */
    public function nextIdentity(): LayoutId
    {
        return LayoutId::generate();
    }

    /**
     * @inheritdoc
     */
    public function save(Layout $layout): void
    {
        $this->manager->persist($layout);
        $this->manager->flush();
    }

    /**
     * @inheritdoc
     */
    public function removeAll(): void
    {
        $this->manager->createQueryBuilder()
            ->delete(Layout::class)
            ->getQuery()
            ->execute();
    }

    /**
     * @inheritdoc
     */
    public function latestByName(string $name): Layout
    {
        /** @var Layout|null $layout */
        $layout = $this->manager->createQueryBuilder()
            ->select('t')
            ->from(Layout::class, 't')
            ->where('t.name = :name')
            ->setMaxResults(1)
            ->orderBy('t.createdAt', 'desc')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();

        if ($layout === null) {
            throw new LayoutNotFoundException(
                'Layout with name "' . $name . '" not found.'
            );
        }

        return $layout;
    }
}
