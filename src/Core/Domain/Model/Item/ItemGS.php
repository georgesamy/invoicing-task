<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Item;

use App\Core\Domain\Model\Invoice\Invoice;

trait ItemGS
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    private function setPrice(int $price): void
    {
        $this->price = $price;
    }

    private function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    private function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }
}
