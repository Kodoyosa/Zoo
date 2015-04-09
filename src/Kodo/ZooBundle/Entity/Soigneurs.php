<?php

namespace Kodo\ZooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Soigneurs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kodo\ZooBundle\Entity\Repository\SoigneursRepository")
 */
class Soigneurs
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
     * @ORM\Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateembauche", type="date")
     */
    private $dateembauche;


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
     * Set dateembauche
     *
     * @param \DateTime $dateembauche
     * @return Soigneurs
     */
    public function setDateembauche($dateembauche)
    {
        $this->dateembauche = $dateembauche;

        return $this;
    }

    /**
     * Get dateembauche
     *
     * @return \DateTime 
     */
    public function getDateembauche()
    {
        return $this->dateembauche;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Soigneurs
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
}
