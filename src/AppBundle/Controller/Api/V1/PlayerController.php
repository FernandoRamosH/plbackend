<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 1/06/18
 * Time: 18:16
 */

namespace AppBundle\Controller\Api\V1;

use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;

class PlayerController extends Controller
{
    /**
     * @param Team $team
     * @Route("players/{id}", name="players_by_team_list")
     */
    public function players(Team $team = null)
    {
        if (null === $team) {
            return new JsonResponse(['Error' => 'Team not exists'], 404);
        }

        $playersData = [];
        foreach ($team->getPlayers() as $player) {
            $playersData[] = [
                'id' => $player->getId(),
                'fullName' => $player->getFullName(),
                'position' => $player->getPosition(),
                'number' => $player->getNumber(),
                'nationality' => $player->getNationality(),
            ];
        }

        return new JsonResponse($playersData);
    }
}
