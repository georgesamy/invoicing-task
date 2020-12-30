<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Item;

use Doctrine\ORM\Mapping as ORM;

use App\Core\Domain\Model\Invoice\Invoice;

/**
 * @ORM\Entity()
 */
class Item
{
    use ItemGS;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true})
     */
    private int $price;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned": true})
     */
    private int $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Core\Domain\Model\Invoice\Invoice")
     * @ORM\JoinColumn(onDelete="cascade", nullable=false)
     */
    private Invoice $invoice;

    public function __construct(string $name, int $price, int $quantity, Invoice $invoice)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setInvoice($invoice);

        //$this->raise(new TaskCreatedEvent($this));
    }

    // API

    public function changeName(string $name): void
    {
        $this->setName($name);
    }

    public function changePrice(string $price): void
    {
        $this->setPrice($price);
    }

    public function changeQuantity(string $quantity): void
    {
        $this->setQuantity($quantity);
    }

    public function changeInvoice(Invoice $invoice): void
    {
        $this->setInvoice($invoice);
    }

}
