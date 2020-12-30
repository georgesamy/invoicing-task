<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Recipient;

abstract class RecipientCommand
{
    protected string $name;

    protected string $address;

    protected string $country;

    public function __construct(string $name, string $address, string $country)
    {
        $this->name = $name;
        $this->address = $address;
        $this->country = $country;
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
}
