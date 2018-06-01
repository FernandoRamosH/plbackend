<?php
/**
 * User: Fernando Ramos (framosh@outlook.es)
 * Date: 30/05/18
 * Time: 22:31
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player
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
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message = "fullName is required")
     */
    private $fullName;

    /**
     * @var integer
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\NotBlank(message = "number is required")
     * @Assert\Type(
     *     type="digit",
     *     message="The number of the shirt must be integer"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 99,
            minMessage = "The shirt number must be at least {{ limit }}",
     *      maxMessage = "The number of the shirt must be at most {{ limit }}"
     * )
     */ //TODO: Validar que otro jugador del equipo no tiene el mismo número
    private $number;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message = "position is required")
     * @Assert\Choice(
     *     strict=true,
     *     choices={"Central","Delantero centro","Extremo derecho","Extremo izquierdo","Lateral derecho","Lateral izquierdo","Mediapunta","Mediocentro","Mediocentro defensivo","Mediocentro ofensivo","Portero"},
     *     message="The position must be one of the following: Central|Delantero centro|Extremo derecho|Extremo izquierdo|Lateral derecho|Lateral izquierdo|Mediapunta|Mediocentro|Mediocentro defensivo|Mediocentro ofensivo|Portero"
     * )
     */
    private $position;

    /**
     * @var \DateTime
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message = "dateOfBirth is required and format must be yyyy-mm-dd")
     * @Assert\DateTime(format = "Y-m-d", message = "dateOfBirth incorrect format, format: yyyy-mm-dd")
     */
    private $dateOfBirth;

    /**
     * @var string
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\NotBlank(message = "nationality is required")
     */
    private $nationality;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="players")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id", nullable=true)
     * @Assert\NotNull(message = "teamId is required and must have a valid value")
     */
    private $team;

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
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        if (is_string($dateOfBirth)) {
            $dateOfBirth = \DateTime::createFromFormat('Y-m-d', $dateOfBirth);
        }
        if ($dateOfBirth) {
            $this->dateOfBirth = $dateOfBirth;
        }
    }

    /**
     * @return string
     */
    public function getNationality(): string
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team $team
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;
    }
}
