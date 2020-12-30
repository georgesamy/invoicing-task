<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Model\Item\Item;
use App\Core\Domain\Model\Item\ItemRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemRepository implements ItemRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Item
    {
        return $this->em->find(Item::class, $id);
    }

    public function save(Item $item): void
    {
        $this->em->persist($item);
        $this->em->flush();
    }
}
