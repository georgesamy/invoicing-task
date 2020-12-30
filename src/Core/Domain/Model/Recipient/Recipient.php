<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Recipient;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Recipient
{
    use RecipientGS;

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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $country;

    public function __construct(string $name, string $address, string $country)
    {
        $this->setName($name);
        $this->setAddress($address);
        $this->setCountry($country);

        //$this->raise(new TaskCreatedEvent($this));
    }

    // API

    public function changeName(string $name): void
    {
        $this->setName($name);
    }

    public function changeAddress(string $address): void
    {
        $this->setAddress($address);
    }

    public function changeCountry(string $country): void
    {
        $this->setCountry($country);
    }

}
