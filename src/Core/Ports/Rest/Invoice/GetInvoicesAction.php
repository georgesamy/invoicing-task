<?php

declare(strict_types=1);

namespace App\Core\Ports\Rest\Invoice;

use App\Core\Application\Query\Invoice\DTO\InvoiceDTO;
use App\Core\Application\Query\Invoice\GetInvoices\GetInvoicesQuery;
use App\Shared\Infrastructure\Http\HttpSpec;
use App\Shared\Infrastructure\Http\ParamFetcher;
use App\Shared\Infrastructure\ValueObject\PaginatedData;
use App\Shared\Infrastructure\ValueObject\Pagination;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class GetInvoicesAction
{
    use HandleTrait;

    private NormalizerInterface $normalizer;

    public function __construct(MessageBusInterface $queryBus, NormalizerInterface $normalizer)
    {
        $this->messageBus = $queryBus;
        $this->normalizer = $normalizer;
    }

    /**
     * @Route("/api/invoices", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function __invoke(Request $request): Response
    {
        $query = new GetInvoicesQuery();

        $data = $this->handle($query);
        
        return new JsonResponse($data);
    }
}
