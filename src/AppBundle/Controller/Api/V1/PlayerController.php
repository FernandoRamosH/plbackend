<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 1/06/18
 * Time: 18:16
 */

namespace AppBundle\Controller\Api\V1;

use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PlayerController extends Controller
{
    /**
     * @param Team $team
     * @Route("players/{id}", name="players_by_team_list")
     */
    public function list(Team $team = null)
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


    /**
     * @Route("player", name="create_player")
     * @Method({"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $player = new Player();
        $player->setFullName($request->get('fullName'));
        $player->setNumber($request->get('number'));
        $player->setPosition($request->get('position'));
        $player->setDateOfBirth($request->get('dateOfBirth'));
        $player->setNationality($request->get('nationality'));
        if ($teamId = $request->get('teamId')) {
            $team  = $entityManager->getRepository('AppBundle:Team')->find($teamId);
            $team && $player->setTeam($team);
        }

        $errors = $validator->validate($player);
        if (count($errors) > 0) {
            return $this->getResponseValidationErrors($errors);
        }

        $entityManager->persist($player);
        $entityManager->flush();

        return new JsonResponse(['status' => 'ok', 'playerId' => $player->getId()]);
    }

    private function getResponseValidationErrors($errors)
    {
        $listErrors = [];
        foreach ($errors as $error) {
            $listErrors[] = $error->getMessage();
        }
        return new JsonResponse(
            [
                'status' => 'error',
                'msg' => implode(', ', $listErrors)
            ],
            400
        );
    }
}
