<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 1/06/18
 * Time: 18:07
 */

namespace AppBundle\Controller\Api\V1;

use AppBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TeamController extends Controller
{
    /**
     * List Of teams
     *
     * @Route("teams", name="team_list")
     */
    public function list()
    {
        $teams = $this
            ->getDoctrine()
            ->getRepository(Team::class)
            ->findAll();

        $teamData = [];
        foreach ($teams as $team) {
            $teamData[] = [
                'id' => $team->getId(),
                'name' => $team->getName(),
                'shortName' => $team->getShortName(),
                'shieldUrl' => $team->getShieldUrl(),
                'playersInTeamUrl' => $this->generateUrl('players_by_team_list', ['id' => $team->getId()], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }

        return new JsonResponse($teamData);
    }
}
