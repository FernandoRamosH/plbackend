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
    public function testCreatePlayer()
    {
        $client = static::createClient();
        $team = $this->getExistingTeam($client);

        $request = $client->request(
            'POST',
            '/api/v1/player',
            [
                'teamId' => $team['id'],
                'number' => '25',
                'fullName' => 'Fernando Hierro',
                'position' => 'Central',
                'dateOfBirth' => '1955-05-01',
                'nationality' => 'Spain'
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $status = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('ok', $status['status']);
        $this->assertNotEmpty($status['playerId']);
    }

    /**
     * @dataProvider dataPlayersWithErrorsProvider
     */
    public function testCreatePlayerWithErrorsShouldReturn400($teamId, $number, $fullName, $position, $dateOfBirth, $nationality)
    {
        $client = static::createClient();
        $request = $client->request(
            'POST',
            '/api/v1/player',
            [
                'teamId' => $teamId,
                'number' => $number,
                'fullName' => $fullName,
                'position' => $position,
                'dateOfBirth' => $dateOfBirth,
                'nationality' => $nationality
            ]
        );
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $status = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('error', $status['status']);
    }

    public function dataPlayersWithErrorsProvider()
    {
        $client = static::createClient();
        $team = $this->getExistingTeam($client);
        return [
            ['', '33', 'Manolito', 'Central', '1978-02-10', 'France'],
            ['999999', '33', 'Manolito', 'Central', '1978-02-10', 'France'],
            [$team['id'], '100', 'Manolito', 'Central', '1978-02-10', 'France'],
            [$team['id'], '100', '', 'Central', '1978-02-10', 'France'],
            [$team['id'], '100', 'Manolito', 'Utillero', '1978-02-10', 'France'],
            [$team['id'], '100', 'Manolito', 'Utillero', '01-01-2000', 'France'],
            [$team['id'], '100', 'Manolito', 'Utillero', '01-01-2000', ''],
        ];
    }

    private function getExistingTeam($client)
    {
        $crawlerTeams = $client->request('GET', '/api/v1/teams');
        $teams = json_decode($client->getResponse()->getContent(), true);
        $team = reset($teams);
        return $team;
    }
}
