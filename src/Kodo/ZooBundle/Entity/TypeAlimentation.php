<?php

namespace Kodo\ZooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeAlimentation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kodo\ZooBundle\Entity\Repository\TypeAlimentationRepository")
 */
class TypeAlimentation
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


    /**
     *
     * @ORM\ManyToMany(targetEntity="Animaux", inversedBy="manger")
     */
    protected $animal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animal = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set libelle
     *
     * @param string $libelle
     * @return TypeAlimentation
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Add animal
     *
     * @param \Kodo\ZooBundle\Entity\Animaux $animal
     * @return TypeAlimentation
     */
    public function addAnimal(\Kodo\ZooBundle\Entity\Animaux $animal)
    {
        $this->animal[] = $animal;

        return $this;
    }

    /**
     * Remove animal
     *
     * @param \Kodo\ZooBundle\Entity\Animaux $animal
     */
    public function removeAnimal(\Kodo\ZooBundle\Entity\Animaux $animal)
    {
        $this->animal->removeElement($animal);
    }

    /**
     * Get animal
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnimal()
    {
        return $this->animal;
    }
}
