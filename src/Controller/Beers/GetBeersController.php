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
        $queryParams = $request->query->get(parent::QUERY_PARAM_NAME, parent::NULL_VALUE);
        if (isset($queryParams)) {
            if (!is_string($queryParams)) {
                throw new ApiInvalidRequestException('Invalid parameter');
            }
            $options["query"]["food"] = $queryParams;
        }

        return $options;
    }

    protected function formatResult($punkResponse)
    {
        $decodedResponse = json_decode($punkResponse, true);
        $arrayData = [];
        foreach ($decodedResponse as $value) {
            array_push($arrayData, [
                'id' => $value['id'],
                'name' => $value['name'],
                'description' => $value['description']
            ]);
        }

        return $arrayData;
    }
}
