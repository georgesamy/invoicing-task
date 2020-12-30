<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;

use App\Core\Domain\Model\Recipient\Recipient;
use App\Core\Domain\Exception\BusinessLogicViolationException;

/**
 * @ORM\Entity()
 */
class Invoice
{
    use InvoiceGS;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private int $id;

    /**
     * @ORM\Embedded(class="App\Core\Domain\Model\Invoice\Status", columnPrefix=false)
     */
    private Status $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Domain\Model\Recipient\Recipient")
     * @ORM\JoinColumn(onDelete="cascade", nullable=false)
     */
    private Recipient $recipient;

    /**
     * @ORM\OneToMany(targetEntity="App\Core\Domain\Model\Item\Item", mappedBy="invoice")
     */
    private $items;


    public function __construct(Recipient $recipient)
    {
        $this->setRecipient($recipient);
        $this->setStatus(Status::CREATED());
        $this->items = [];

        //$this->raise(new TaskCreatedEvent($this));
    }

    // API

    public function changeRecipient(Recipient $recipient)
    {
        $this->setRecipient($recipient);
    }

    public function send()
    {
        // check if created and then proceed
        if ($this->status->is(Status::SENT)) {
            return;
        }

        if ($this->status->is(Status::PAID)) {
            throw new BusinessLogicViolationException('Paid invoice can\'t be sent');
        }

        $this->setStatus(Status::SENT());
    }

    public function pay()
    {
        if ($this->status->is(Status::PAID)) {
            return;
        }
        if ($this->status->is(Status::CREATED)) {
            throw new BusinessLogicViolationException('Invoice must be sent first');
        }

        $this->setStatus(Status::PAID());
    }
}
