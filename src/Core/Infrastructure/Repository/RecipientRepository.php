<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Model\Recipient\Recipient;
use App\Core\Domain\Model\Recipient\RecipientRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RecipientRepository implements RecipientRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save(Recipient $recipient): Recipient
    {
        $this->em->persist($recipient);
        $this->em->flush();
        return $recipient;
    }
}
