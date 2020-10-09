<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\GuzzleHttpClientService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class ApiController extends AbstractFOSRestController
{
    const URL = 'https://api.punkapi.com/v2/beers/';
    const NULL_VALUE = null;
    const QUERY_PARAM_NAME = 'food';

    protected $guzzleHttpClientService;

    public function __construct(GuzzleHttpClientService $guzzleHttpClientService)
    {
        $this->guzzleHttpClientService = $guzzleHttpClientService;
    }

    protected function punkApiRequest(Request $request)
    {
        try {
            $statusCode = Response::HTTP_OK;
            $options = $this->setOptions($request);
            $punkResponse = $this->guzzleHttpClientService->request(
                Request::METHOD_GET,
                self::URL,
                $options
            );
            $response = ["results" => $this->formatResult($punkResponse)];
        } catch (\Exception $ex) {
            $statusCode = Response::HTTP_FAILED_DEPENDENCY;
            $response = ['message' => 'Request error'];
        }

        return new JsonResponse($response, $statusCode);
    }

    abstract protected function setOptions(Request $request);
    abstract protected function formatResult($punkResponse);
}
