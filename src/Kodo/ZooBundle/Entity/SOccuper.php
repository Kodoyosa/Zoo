<?php

namespace Kodo\ZooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SOccuper
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kodo\ZooBundle\Entity\Repository\SOccuperRepository")
 */
class SOccuper
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateheurealimentation", type="datetime", nullable=true)
     */
    private $dateheurealimentation;

    /**
     * @var integer
     *
     * @ORM\Column(name="qte", type="integer", nullable=true)
     */
    private $qte;


    /**
     * @ORM\ManyToOne(targetEntity="Soigneurs")
     */
    protected $soigneur;

    /**
     * @ORM\ManyToOne(targetEntity="Animaux")
     */
    private $animal;

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
     * Set dateheurealimentation
     *
     * @param \DateTime $dateheurealimentation
     * @return SOccuper
     */
    public function setDateheurealimentation($dateheurealimentation)
    {
        $this->dateheurealimentation = $dateheurealimentation;

        return $this;
    }

    /**
     * Get dateheurealimentation
     *
     * @return \DateTime 
     */
    public function getDateheurealimentation()
    {
        return $this->dateheurealimentation;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     * @return SOccuper
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer 
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set soigneur
     *
     * @param \Kodo\ZooBundle\Entity\Soigneurs $soigneur
     * @return SOccuper
     */
    public function setSoigneur(\Kodo\ZooBundle\Entity\Soigneurs $soigneur = null)
    {
        $this->soigneur = $soigneur;

        return $this;
    }

    /**
     * Get soigneur
     *
     * @return \Kodo\ZooBundle\Entity\Soigneurs 
     */
    public function getSoigneur()
    {
        return $this->soigneur;
    }

    /**
     * Set animal
     *
     * @param \Kodo\ZooBundle\Entity\Animaux $animal
     * @return SOccuper
     */
    public function setAnimal(\Kodo\ZooBundle\Entity\Animaux $animal = null)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return \Kodo\ZooBundle\Entity\Animaux 
     */
    public function getAnimal()
    {
        return $this->animal;
    }
}
