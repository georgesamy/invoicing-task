<?php

declare(strict_types=1);

namespace App\Core\Application\Command\Recipient\CreateRecipient;

use App\Core\Domain\Model\Recipient\Recipient;
use App\Core\Domain\Model\Recipient\RecipientRepositoryInterface;

final class CreateRecipientCommandHandler
{
    private RecipientRepositoryInterface $recipientRepository;

    public function __construct(RecipientRepositoryInterface $recipientRepository)
    {
        $this->recipientRepository = $recipientRepository;
    }

    public function __invoke(CreateRecipientCommand $command): int
    {
        $recipient = new Recipient($command->getName(), $command->getAddress(), $command->getCountry());
        $this->recipientRepository->add($recipient);

        return $recipient->getId();
    }
}
