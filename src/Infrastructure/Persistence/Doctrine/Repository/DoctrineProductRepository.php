<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Gstawarczyk\Cobiro\Domain\Model\Product;
use Gstawarczyk\Cobiro\Domain\Model\Uuid;
use Gstawarczyk\Cobiro\Domain\Repository\ProductRepository;

/**
 * @method null|Product findOneBy(array $criteria, array $orderBy = null)
 */
class DoctrineProductRepository extends EntityRepository implements ProductRepository
{
    public function findById(Uuid $id): ?Product
    {
        return $this->findOneBy(['id' => $id->__toString()]);
    }

    public function save(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }
}
