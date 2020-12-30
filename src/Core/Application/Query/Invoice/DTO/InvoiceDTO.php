<?php

declare(strict_types=1);

namespace App\Core\Application\Query\Invoice\DTO;

use App\Core\Domain\Model\Invoice\Invoice;

final class InvoiceDTO
{
    public int $id;

    public int $net;

    public int $gross;

    public float $vat;

    public string $status;

    public array $items;

    public static function fromEntity(Invoice $invoice): InvoiceDTO
    {
        $dto = new static();
        $dto->setId($invoice->getId());
        $dto->setItems($invoice->getItems()->toArray());
        $dto->setStatus((string) $invoice->getStatus());

        $net = self::calculateNet($invoice->getItems());
        $dto->setNet($net);

        $vat = self::calculateVat($invoice->getRecipient()->getCountry());
        $dto->setVat($vat);

        $gross = self::calculateGross($net, $vat);
        $dto->setGross($gross);

        return $dto;
    }

    public static function calculateNet($items): int
    {
        $price = 0;
        foreach ($items as $item) {
            $price+= ($item->getPrice() * $item->getQuantity());
        }
        return $price;
    }

    public static function calculateVat($country): float
    {
        switch ($country) {
            case 'Germany':
                return 0.19;
            case 'Austria':
                return 0.2;
            case 'USA':
                return 0;
            return 0;
        }
    }

    public static function calculateGross(int $net, float $vat): int
    {
        return intval($net + ($vat * $net));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNet(): int
    {
        return $this->net;
    }

    private function setNet(int $net): void
    {
        $this->net = $net;
    }

    public function getGross(): int
    {
        return $this->gross;
    }

    private function setGross(int $gross): void
    {
        $this->gross = $gross;
    }

    public function getVat(): int
    {
        return $this->vat;
    }

    private function setVat(float $vat): void
    {
        $this->vat = $vat;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    private function setStatus(string $status): void
    {
        $this->status = $status;
    }

    private function setItems(array $items): void
    {
        $this->items = $items;
    }
}
