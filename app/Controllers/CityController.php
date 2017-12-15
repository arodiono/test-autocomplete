<?php

namespace App\Controllers;

use App\Models\City;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CityController
 * @package App\Controllers
 */
class CityController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getMap(Request $request, Response $response): Response
    {
        $this->view->addAttribute('base_url', $request->getUri()->getBasePath());
        return $this->view->render($response, 'map.php', []);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getCities(Request $request, Response $response): Response
    {
        $data = City::all()->toArray();
        return $response->withJson($data);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function addCity(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        if (!City::isExist($data['id'])) {
            City::create([
                'place_id' => $data['id'],
                'name' => $data['name'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude']
            ]);
        }
        return $response->withStatus(200);
    }
}