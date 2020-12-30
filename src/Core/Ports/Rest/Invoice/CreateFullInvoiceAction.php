<?php

declare(strict_types=1);

namespace App\Core\Ports\Rest\Invoice;

use App\Core\Application\Command\Invoice\CreateFullInvoice\CreateFullInvoiceCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

final class CreateFullInvoiceAction
{
    use HandleTrait;

    private RouterInterface $router;

    public function __construct(MessageBusInterface $commandBus, RouterInterface $router)
    {
        $this->messageBus = $commandBus;
        $this->router = $router;
    }

    /**
     * @Route("/api/invoices", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function __invoke(Request $request): Response
    {
        // Get data from the request
        $payload = json_decode($request->getContent(), true);
        $recipient = $payload["recipient"];
        $items = $payload["items"];
        // TODO: validations
        $command = new CreateFullInvoiceCommand(
            $recipient["name"],
            $recipient["address"],
            $recipient["country"],
            $items
        );

        $id = $this->handle($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
