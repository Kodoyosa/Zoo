<?php

namespace Kodo\ZooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Animaux
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kodo\ZooBundle\Entity\Repository\AnimauxRepository")
 */
class Animaux
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissance", type="date")
     */
    private $datenaissance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedeces", type="date",nullable=true)
     */
    private $datedeces;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=1)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="text")
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="Especes")
     *
     */
    private $espece;

    /**
     * @ORM\ManyToMany(targetEntity="TypeAlimentation", mappedBy="animal")
     */
    private $manger;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manger = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Animaux
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return Animaux
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set datedeces
     *
     * @param \DateTime $datedeces
     * @return Animaux
     */
    public function setDatedeces($datedeces)
    {
        $this->datedeces = $datedeces;

        return $this;
    }

    /**
     * Get datedeces
     *
     * @return \DateTime 
     */
    public function getDatedeces()
    {
        return $this->datedeces;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Animaux
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return Animaux
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Animaux
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set espece
     *
     * @param \Kodo\ZooBundle\Entity\Especes $espece
     * @return Animaux
     */
    public function setEspece(\Kodo\ZooBundle\Entity\Especes $espece = null)
    {
        $this->espece = $espece;

        return $this;
    }

    /**
     * Get espece
     *
     * @return \Kodo\ZooBundle\Entity\Especes 
     */
    public function getEspece()
    {
        return $this->espece;
    }

    /*private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
            return;
        }

        // On récupère le nom original du fichier de l'internaute
        $name = $this->file->getClientOriginalName();

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move($this->getUploadRootDir(), $name);

        // On sauvegarde le nom de fichier dans notre attribut $url
        $this->photo = $name;

    }


    public function getUploadDir()
    {
        return 'bundles/kodozoo/images';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }*/


    /**
     * Add manger
     *
     * @param \Kodo\ZooBundle\Entity\TypeAlimentation $manger
     * @return Animaux
     */
    public function addManger(\Kodo\ZooBundle\Entity\TypeAlimentation $manger)
    {
        $this->manger[] = $manger;

        return $this;
    }

    /**
     * Remove manger
     *
     * @param \Kodo\ZooBundle\Entity\TypeAlimentation $manger
     */
    public function removeManger(\Kodo\ZooBundle\Entity\TypeAlimentation $manger)
    {
        $this->manger->removeElement($manger);
    }

    /**
     * Get manger
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManger()
    {
        return $this->manger;
    }
}
