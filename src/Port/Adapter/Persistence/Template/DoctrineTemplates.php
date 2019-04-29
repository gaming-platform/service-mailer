<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Persistence\Template;

use Doctrine\ORM\EntityManager;
use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;
use GamingPlatform\Mailer\Domain\Template\Template;
use GamingPlatform\Mailer\Domain\Template\Templates;

final class DoctrineTemplates implements Templates
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * DoctrineTemplates constructor.
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
    public function latestByName(string $name): Template
    {
        $repository = $this->manager->getRepository(Template::class);

        /** @var Template|null $template */
        $template = $repository->createQueryBuilder('t')
            ->where('t.name = :name')
            ->setMaxResults(1)
            ->orderBy('t.createdAt', 'desc')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();

        if ($template === null) {
            throw new TemplateNotFoundException(
                'Template with name "' . $name . '" not found.'
            );
        }

        return $template;
    }
}
