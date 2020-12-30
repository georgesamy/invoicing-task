<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Invoice\MakeInvoicePaid;

use App\Core\Domain\Model\Invoice\InvoiceRepositoryInterface;

final class MakeInvoicePaidCommandHandler
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function __invoke(MakeInvoicePaidCommand $command): void
    {
        $invoice = $this->invoiceRepository->find($command->getId());

        if ($invoice === null) {
            throw new ResourceNotFoundException(sprintf('Invoice with id "%s" is not found', $command->getId()));
        }

        $invoice->pay();

        $this->invoiceRepository->save($invoice);
    }
}
