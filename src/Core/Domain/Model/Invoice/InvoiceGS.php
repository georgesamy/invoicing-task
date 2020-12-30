<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Invoice;

use App\Core\Domain\Model\Recipient\Recipient;

use Doctrine\ORM\PersistentCollection;

trait InvoiceGS
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getItems(): PersistentCollection
    {
        return $this->items;
    }

    public function getRecipient(): Recipient
    {
        return $this->recipient;
    }

    private function setRecipient(Recipient $recipient): void
    {
        $this->recipient = $recipient;
    }

    public function getStatus(): string
    {
        return (string) $this->status;
    }

    private function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}
