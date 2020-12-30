<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Invoice;

interface InvoiceRepositoryInterface
{
    public function find(int $id): ?Invoice;

    public function findAll(): ?array;

    public function save(Invoice $invoice): Invoice;
}
