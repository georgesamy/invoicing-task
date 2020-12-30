<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Invoice\MakeInvoiceSent;

use App\Core\Domain\Model\Invoice\InvoiceRepositoryInterface;
use App\Core\Domain\Exception\ResourceNotFoundException;

final class MakeInvoiceSentCommandHandler
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function __invoke(MakeInvoiceSentCommand $command): void
    {
        $invoice = $this->invoiceRepository->find($command->getId());

        if ($invoice === null) {
            throw new ResourceNotFoundException(sprintf('Invoice with id "%s" is not found', $command->getId()));
        }

        $invoice->send();

        $this->invoiceRepository->save($invoice);
    }
}
