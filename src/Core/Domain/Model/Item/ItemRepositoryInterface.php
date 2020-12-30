<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Item;

interface ItemRepositoryInterface
{
    public function find(int $id): ?Item;
    public function save(Item $item): void;
}
