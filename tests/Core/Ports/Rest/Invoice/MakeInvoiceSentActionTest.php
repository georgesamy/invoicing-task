<?php

namespace App\Core\Ports\Rest\Invoice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Core\Domain\Model\Invoice\Invoice;
use App\Core\Domain\Model\Invoice\Status;

class MakeInvoiceSentActionTest extends WebTestCase
{
    private $entityManager;

    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testMakeInvoiceSent()
    {
        $createdInvoice = $this->entityManager->getRepository(Invoice::class)->findOneBy(['status.status' => Status::CREATED]);

        $id = $createdInvoice->getId();

        $this->client->request('PATCH', "/api/invoices/$id/status/sent");

        $this->assertEquals(204, $this->client->getResponse()->getStatusCode());
    }
}
