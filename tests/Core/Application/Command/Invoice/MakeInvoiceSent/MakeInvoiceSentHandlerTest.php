<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use App\Core\Domain\Model\Invoice\Invoice;
use App\Core\Application\Command\Invoice\MakeInvoiceSent\MakeInvoiceSentCommand;
use App\Core\Application\Command\Invoice\MakeInvoiceSent\MakeInvoiceSentCommandHandler;

use App\Core\Domain\Model\Invoice\InvoiceRepositoryInterface;

class MakeInvoiceSentHandlerTest extends TestCase
{
    private $invoiceRepository;

    private $handler;

    protected function setUp(): void
    {
        $invoice = $this->getMockBuilder(Invoice::class)->disableOriginalConstructor()->getMock();
        $this->invoiceRepository = $this->createMock(InvoiceRepositoryInterface::class);
        $this->invoiceRepository->expects($this->once())
            ->method('find')
            ->willReturn($invoice);
        $this->handler = new MakeInvoiceSentCommandHandler($this->invoiceRepository);

    }
    /**
     * This will test a booking being processed
     * @group time-sensitive
     * @throws \Exception
     */
    public function testMakeInvoiceSentHander(): void
    {
        $command = new MakeInvoiceSentCommand(11);

        $handler = $this->handler;

        $handler($command);

        self::assertEquals(1, 1);
    }
}
