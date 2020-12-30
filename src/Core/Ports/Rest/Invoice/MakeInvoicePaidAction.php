<?php

declare(strict_types=1);

namespace App\Core\Ports\Rest\Invoice;

use App\Core\Application\Command\Invoice\MakeInvoicePaid\MakeInvoicePaidCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

final class MakeInvoicePaidAction
{
    use HandleTrait;

    private RouterInterface $router;

    public function __construct(MessageBusInterface $commandBus, RouterInterface $router)
    {
        $this->messageBus = $commandBus;
        $this->router = $router;
    }

    /**
     * @Route("/api/invoices/{id}/status/paid", methods={"PATCH"})
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function __invoke(Request $request): Response
    {
        $command = new MakeInvoicePaidCommand(
            (int)$request->attributes->get('id')
        );

        $id = $this->handle($command);

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
