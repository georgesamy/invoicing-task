<?php

namespace App\DataFixtures;

use App\Core\Domain\Model\Invoice\Invoice;
use App\Core\Domain\Model\Recipient\Recipient;
use App\Core\Domain\Model\Item\Item;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InvoiceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $recipient = new Recipient("George", "1 degla", "Germany");
        $manager->persist($recipient);

        $invoice = new Invoice($recipient);
        $manager->persist($invoice);

        $item1 = new Item("Charger", 50000, 2, $invoice);
        $manager->persist($item1);
        $item2 = new Item("Wireless Headset", 200000, 1, $invoice);
        $manager->persist($item2);

        $manager->flush();
    }
}
