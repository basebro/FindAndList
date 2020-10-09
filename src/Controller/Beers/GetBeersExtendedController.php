<?php

namespace App\Controller\Beers;

use App\Controller\ApiController;
use App\Exception\ApiInvalidRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/api/v1", name="v1_")
 */
class GetBeersExtendedController extends ApiController
{
    
    const NULL_VALUE = null;
    const QUERY_PARAM_NAME = 'food';

    /**
     * @Route("/beers/extended", name="get_beers_extended", methods={"GET"})
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
                'description' => $value['description'],
                'image' => $value['image_url'],
                'slogan' => $value['tagline'],
                'first_brewed' => $value['first_brewed'],
            ]);
        }

        return $arrayData;
    }
}
