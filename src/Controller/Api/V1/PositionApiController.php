<?php

namespace App\Controller\Api\V1;

use App\Controller\Api\ApiController;
use Pimcore\Model\DataObject\Position;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PositionApiController extends ApiController
{
    /**
     * 1 API per posizioni aperte (con lingua nella URL) --> /{lang}/v1/open-positions GET
     * 1 API per il dettaglio della posizione /{lang}/v1/open-positions/{id} GET
     */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(path: '/{lang}/v1/open-positions', name: 'api_v1_position_listing', methods: ["GET"])]
    public function getOpenPositions(Request $request): JsonResponse
    {
        $listing = new Position\Listing();
        $positions = $listing->load();

        $lang = $request->query->get('lang', 'en');

        $data = array_map(function ($position) use ($lang) {
            return $this->getPositionData($position, $lang);
        }, $positions);

        return new JsonResponse($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(path: '/{lang}/v1/open-positions/{id}', name: 'api_v1_position_detail', methods: ["GET"])]
    public function getPosition(string $id, string $lang, Request $request): JsonResponse
    {
        $position = Position::getById($id);
        $data = $this->getPositionData($position, $lang);

        return new JsonResponse($data);
    }

    protected function getPositionData(Position $position, string $lang): array
    {
        return [
            'id' => $position->getId(),
            'title' => $position->getTitle($lang),
            'description' => $position->getDescription($lang),
            'site' => $position->getSite(),
            'category' => $position->getCategory()->getTitle($lang),
        ];
    }
}
