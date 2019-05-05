<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer\Port\Adapter\Persistence\Template;

use Doctrine\ORM\EntityManager;
use GamingPlatform\Mailer\Domain\Template\Exception\TemplateNotFoundException;
use GamingPlatform\Mailer\Domain\Template\Template;
use GamingPlatform\Mailer\Domain\Template\TemplateId;
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
    public function nextIdentity(): TemplateId
    {
        return TemplateId::generate();
    }

    /**
     * @inheritdoc
     */
    public function save(Template $template): void
    {
        $this->manager->persist($template);
        $this->manager->flush();
    }

    /**
     * @inheritdoc
     */
    public function remove(string $name): void
    {
        $numberOfAffectedRows = $this->manager->createQueryBuilder()
            ->delete(Template::class, 't')
            ->where('t.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->execute();

        if ($numberOfAffectedRows === 0) {
            throw new TemplateNotFoundException(
                'Template with name "' . $name . '" not found.'
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function removeRevision(string $name, TemplateId $templateId): void
    {
        $numberOfAffectedRows = $this->manager->createQueryBuilder()
            ->delete(Template::class, 't')
            ->where('t.name = :name')
            ->andWhere('t.templateId.templateId = :templateId')
            ->setParameter('name', $name)
            ->setParameter('templateId', $templateId->toString(), 'uuid_binary_ordered_time')
            ->getQuery()
            ->execute();

        if ($numberOfAffectedRows === 0) {
            throw new TemplateNotFoundException(
                'Template revision "' . $templateId->toString() . '" not found.'
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function removeAll(): void
    {
        $this->manager->createQueryBuilder()
            ->delete(Template::class)
            ->getQuery()
            ->execute();
    }

    /**
     * @inheritdoc
     */
    public function latestRevisionByName(string $name): Template
    {
        /** @var Template|null $template */
        $template = $this->manager->createQueryBuilder()
            ->select('t')
            ->from(Template::class, 't')
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
