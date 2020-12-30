<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Recipient;


trait RecipientGS
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    private function setAddress(string $address): void
    {
        $this->address = $address;
    }

    private function setCountry(string $country): void
    {
        $this->country = $country;
    }

}
