<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Invoice\CreateFullInvoice;

use App\Core\Application\Command\Invoice\InvoiceCommand;
use App\Core\Domain\Model\Recipient\Recipient;

class CreateFullInvoiceCommand extends InvoiceCommand
{
    protected Recipient $recipient;

    protected $items;

    public function __construct(string $recipient_name, string $recipient_address, string $recipient_country, array $items)
    {
        parent::__construct();

        $recipient = new Recipient($recipient_name, $recipient_address, $recipient_country);

        $this->recipient = $recipient;
        $this->items = $items;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getItems()
    {
        return $this->items;
    }
}
