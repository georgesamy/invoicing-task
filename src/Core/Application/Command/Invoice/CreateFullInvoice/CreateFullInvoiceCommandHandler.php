<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Invoice\CreateFullInvoice;

use App\Core\Domain\Model\Invoice\Invoice;
use App\Core\Domain\Model\Invoice\InvoiceRepositoryInterface;
use App\Core\Domain\Model\Recipient\RecipientRepositoryInterface;
use App\Core\Domain\Model\Item\Item;
use App\Core\Domain\Model\Item\ItemRepositoryInterface;

final class CreateFullInvoiceCommandHandler
{
    private InvoiceRepositoryInterface $invoiceRepository;
    private RecipientRepositoryInterface $recipientRepository;
    private ItemRepositoryInterface $itemRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository, RecipientRepositoryInterface $recipientRepository, ItemRepositoryInterface $itemRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->recipientRepository = $recipientRepository;
        $this->itemRepository = $itemRepository;
    }

    public function __invoke(CreateFullInvoiceCommand $command): int
    {
        $savedRecipient = $this->recipientRepository->save($command->getRecipient());

        $invoice = new Invoice($savedRecipient);
        $invoice = $this->invoiceRepository->save($invoice);

        foreach ($command->getItems() as $item) {
            $itemObj = new Item($item["name"], $item["price"], $item["quantity"], $invoice);
            $this->itemRepository->save($itemObj);
        }

        return $invoice->getId();
    }
}
