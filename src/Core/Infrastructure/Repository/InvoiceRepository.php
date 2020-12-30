<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Model\Invoice\Invoice;
use App\Core\Domain\Model\Invoice\InvoiceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Invoice
    {
        return $this->em->find(Invoice::class, $id);
    }

    public function findAll(): ?array
    {
        return $this->em->findAll(Invoice::class);
    }

    public function save(Invoice $invoice): Invoice
    {
        $this->em->persist($invoice);
        $this->em->flush();
        return $invoice;
        // Should Item add logic be handled here?
    }

    public function remove(Invoice $invoice): void
    {
        $this->em->remove($invoice);
        $this->em->flush();
    }
}
