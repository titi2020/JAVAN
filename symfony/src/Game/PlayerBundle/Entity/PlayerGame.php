<?php

namespace Game\PlayerBundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="player_game")
 * @ORM\Entity(repositoryClass="Game\PlayerBundle\Entity\PlayerGameRepository")
 *
 * @ORM\HasLifecycleCallbacks
 */
class PlayerGame
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity="Game")
     */
    private $game;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime  $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param mixed $game
     */
    public function setGame($game)
    {
        $this->game = $game;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $created
     * @ORM\PrePersist
     */
    public function setCreated()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updated
     * @ORM\PreUpdate
     */
    public function setUpdated()
    {
        $this->updatedAt = new \DateTime();
    }



}
