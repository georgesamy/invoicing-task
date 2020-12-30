<?php

declare(strict_types=1);

namespace App\Core\Application\Query\Invoice\GetInvoices;

use App\Core\Application\Query\Invoice\DTO\InvoiceDTO;
use App\Core\Domain\Model\Invoice\Invoice;
use App\Core\Domain\Model\User\UserFetcherInterface;
use App\Core\Infrastructure\ValueObject\PaginatedData;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;

final class GetInvoicesQueryHandler
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(GetInvoicesQuery $query): array
    {
        //$qb = $this->buildQuery($query);
        $invoiceTable = $this->em->getClassMetadata(Invoice::class)->getTableName();
        $invoices = $this->em->getRepository(Invoice::class)->findAll();

        $taskDTOs = [];

        foreach ($invoices as $invoice) {
            $invoiceDTOs[] = InvoiceDTO::fromEntity($invoice);
        }
        //dump($invoiceDTOs);exit;
        return $invoiceDTOs;

        return new PaginatedData($taskDTOs, $count);
    }
}
