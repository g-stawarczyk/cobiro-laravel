<?php

declare(strict_types=1);

namespace Gstawarczyk\Cobiro\Ui\Controller\Product;

use Gstawarczyk\Cobiro\Application\Command\CreateProductCommand;
use Gstawarczyk\Cobiro\Application\Handler\CreateProductHandler;
use Gstawarczyk\Cobiro\Domain\Repository\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateProductController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $requestJson = $request->json();
        $productName = $requestJson->get('name');
        $priceAmount = $requestJson->get('price')['amount'];
        $priceCurrency = $requestJson->get('price')['currency'];

        $command = new CreateProductCommand(
            $productName,
            $priceAmount,
            $priceCurrency
        );
        //In production app here should be some Command Bus
        $handler = new CreateProductHandler($this->productRepository);
        $id = $handler->handle($command);

        return response()->json(
            ['id' => $id],
            JsonResponse::HTTP_CREATED
        );
    }
}
