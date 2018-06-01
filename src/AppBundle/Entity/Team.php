<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 30/05/18
 * Time: 22:42
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="team")
 */
class Team
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=40)
     */
    private $shortName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shieldUrl;

    /**
     * @var Collection|Player[]
     * @ORM\OneToMany(targetEntity="Player", mappedBy="team")
     */
    private $players;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName)
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getShieldUrl(): string
    {
        return $this->shieldUrl;
    }

    /**
     * @param string $shieldUrl
     */
    public function setShieldUrl(string $shieldUrl)
    {
        $this->shieldUrl = $shieldUrl;
    }

    /**
     * @return Player[]|Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players->add($player);
    }
}
