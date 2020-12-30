<?php

declare(strict_types=1);

namespace App\Core\Domain\Model\Recipient;

interface RecipientRepositoryInterface
{
    public function save(Recipient $recipient): Recipient;
}
