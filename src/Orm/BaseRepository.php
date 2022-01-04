<?php
declare(strict_types=1);

namespace Jednicky\Orm;

use Doctrine\ORM\EntityRepository;
use Jednicky\Utils\Arrays;
use Nettrine\ORM\EntityManagerDecorator;

abstract class BaseRepository
{
    /** @var EntityManagerDecorator */
    protected $em;

    public function __construct(EntityManagerDecorator $em)
    {
        $this->em = $em;
        //filtr nejde v neonu aktivovat? (Kdyby/Doctrine)
        $this->enableSoftDeleteFilter();
    }

    public function enableSoftDeleteFilter()
    {
        $this->em->getFilters()->enable('softdelete');
    }

    public function disableSoftDeleteFilter()
    {
        $this->em->getFilters()->disable('softdelete');
    }

    protected function getRepository(string $class): EntityRepository
    {
        return $this->em->getRepository($class);
    }

    /**
     * Pokud tě zajímá konkrétní entita: tryGetById()
     * @param string $class
     * @return object[]
     */
    public function findEntityInMemory(string $class): array
    {
        $flushed = Arrays::get($this->em->getUnitOfWork()->getIdentityMap(), $class, []);
        $notFlushed = $this->em->getUnitOfWork()->getScheduledEntityInsertions();
        return array_values(Arrays::filter(array_merge($flushed, $notFlushed), function ($o) use ($class): bool {
            return $o instanceof $class;
        }));
    }

    public function getTableNameByEntity(string $entity): string
    {
        return $this->em->getClassMetadata($entity)->table['name'];
    }

    public function getRootEntityName(string $entity): string
    {
        return $this->em->getClassMetadata($entity)->rootEntityName;
    }
}
