<?php

namespace App\Controller\Beers;

use App\Controller\ApiController;
use App\Exception\ApiInvalidRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/api/v1", name="v1_")
 */
class GetBeersController extends ApiController
{
    const NULL_VALUE = null;
    const QUERY_PARAM_NAME = 'food';

    /**
     * @Route("/beers", name="get_beers", methods={"GET"})
     */
    public function __invoke(Request $request)
    {
        return $this->punkApiRequest($request);
    }

    protected function setOptions(Request $request)
    {
        $options = [];
        $queryParams = $request->query->get(self::QUERY_PARAM_NAME, self::NULL_VALUE);
        if (isset($queryParams)) {
            if (!is_string($queryParams)) {
                throw new ApiInvalidRequestException('Invalid parameter to find');
            }
            $options["query"]["food"] = $queryParams;
        }

        return $options;
    }

    protected function formatResult($punkResponse)
    {
        $arrayData = [];
        $decodedResponse = json_decode($punkResponse, true);
        foreach ($decodedResponse as $value) {
            array_push($arrayData, ['id' => $value['id'], 'name' => $value['name'], 'description' => $value['description']]);
        }
        
        return $arrayData;
    }
}
