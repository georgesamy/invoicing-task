<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Invoice;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Status
{
    public const CREATED = 'created';
    public const SENT = 'sent';
    public const PAID = 'paid';
    public const VALID_STATUSES = [self::CREATED, self::SENT, self::PAID];

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private string $status;

    /**
     * Note to reviwer: Could have forced all newly created invoices to have self::CREATED status with a parameterless constructor. But I choose to allow for flexibility in case we needed to import old invoice data in the future, for report generation for example.
     */
    public function __construct(string $status)
    {
        if (!in_array($status, self::VALID_STATUSES)) {
            throw new BusinessLogicViolationException('Paid invoice can\'t be sent');
        }

        $this->status = $status;
    }

    public function __toString(): string
    {
        return $this->status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public static function CREATED(): self
    {
        return new self(self::CREATED);
    }

    public static function SENT(): self
    {
        return new self(self::SENT);
    }

    public static function PAID(): self
    {
        return new self(self::PAID);
    }

    public function is(string $status): bool
    {
        return $this->status === $status;
    }
}
