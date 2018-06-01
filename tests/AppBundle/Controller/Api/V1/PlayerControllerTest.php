<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 1/06/18
 * Time: 18:54
 */

namespace Tests\AppBundle\Controller\Api\V1;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerControllerTest extends WebTestCase
{
    public function testListOfPlayers()
    {
        $client = static::createClient();

        $crawlerTeams = $client->request('GET', '/api/v1/teams');
        $teams = json_decode($client->getResponse()->getContent(), true);
        $team = reset($teams);

        $crawlerPlayers = $client->request('GET', '/api/v1/players/' . $team['id']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $players = json_decode($client->getResponse()->getContent(), true);
        $this->assertNotEmpty($teams);

        $player = reset($players);
        $this->assertNotEmpty($player['id']);
        $this->assertNotEmpty($player['fullName']);
        $this->assertNotEmpty($player['position']);
        $this->assertNotEmpty($player['nationality']);
        $this->arrayHasKey($player['number']);
    }

    public function testTeamThatNotExistsShouldReturn404()
    {
        $client = static::createClient();

        $crawlerTeams = $client->request('GET', '/api/v1/players/999999999');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}