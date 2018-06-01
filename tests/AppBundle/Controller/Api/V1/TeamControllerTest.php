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
        $this->assertNotEmpty($team['playersInTeamUrl']);
    }
}