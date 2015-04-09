<?php

namespace Kodo\ZooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kodo\ZooBundle\Entity\Repository\EspecesRepository")
 */
class Especes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Animaux")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="denomination", type="string", length=255)
     */
    private $denomination;


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
     * Set denomination
     *
     * @param string $denomination
     * @return Especes
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return string 
     */
    public function getDenomination()
    {
        return $this->denomination;
    }
}
