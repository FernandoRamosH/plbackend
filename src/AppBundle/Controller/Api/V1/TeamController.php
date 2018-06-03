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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TeamController extends Controller
{
    /**
     * List Of teams
     *
     * @Route("teams", name="teams_list")
     * @Method({"GET"})
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
                'detailsTeamUrl' => $this->generateUrl('team_details', ['id' => $team->getId()], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }

        return new JsonResponse($teamData);
    }

    /**
     * @param Team $team
     * @Route("team/{id}", name="team_details")
     * @Method({"GET"})
     */
    public function detail(Team $team = null)
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

        $teamInfo = [
            'id' => $team->getId(),
            'name' => $team->getName(),
            'shortName' => $team->getShortName(),
            'shieldUrl' => $team->getShieldUrl(),
            'players' => $playersData,
        ];

        return new JsonResponse($teamInfo);
    }
}
