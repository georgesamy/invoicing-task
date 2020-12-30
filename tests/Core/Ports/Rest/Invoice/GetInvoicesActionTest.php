<?php

namespace App\Core\Ports\Rest\Invoice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetInvoicesActionTest extends WebTestCase
{
    public function testGetInvoices()
    {
        $client = static::createClient();

        $client->request('GET', '/api/invoices');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
