<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 1/06/18
 * Time: 18:43
 */

namespace Tests\AppBundle\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testListOfTeams()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/teams');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $teams = json_decode($client->getResponse()->getContent(), true);

        $this->assertNotEmpty($teams);

        $team = reset($teams);

        $this->assertNotEmpty($team['id']);
        $this->assertNotEmpty($team['name']);
        $this->assertNotEmpty($team['shortName']);
        $this->assertNotEmpty($team['shieldUrl']);
        $this->assertNotEmpty($team['detailsTeamUrl']);
    }

    public function testDetail()
    {
        $client = static::createClient();

        $team = $this->getExistingTeam($client);

        $crawler = $client->request('GET', '/api/v1/team/' . $team['id']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $teamDetails = json_decode($client->getResponse()->getContent(), true);
        $this->assertNotEmpty($teamDetails['id']);
        $this->assertNotEmpty($teamDetails['name']);
        $this->assertNotEmpty($teamDetails['shortName']);
        $this->assertNotEmpty($teamDetails['shieldUrl']);
        $this->assertNotEmpty($teamDetails['players']);

        $player = reset($teamDetails['players']);
        $this->assertNotEmpty($player['id']);
        $this->assertNotEmpty($player['fullName']);
        $this->assertNotEmpty($player['position']);
        $this->assertNotEmpty($player['nationality']);
        $this->arrayHasKey($player['number']);
    }

    public function testTeamIdThatNotExistsShouldReturn404()
    {
        $client = static::createClient();

        $crawlerTeams = $client->request('GET', '/api/v1/team/999999999');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    private function getExistingTeam($client)
    {
        $crawlerTeams = $client->request('GET', '/api/v1/teams');
        $teams = json_decode($client->getResponse()->getContent(), true);
        $team = reset($teams);
        return $team;
    }
}
