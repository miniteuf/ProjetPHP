<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $Name;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $DownloadLink;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDownload;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDownloadLink(): ?string
    {
        return $this->DownloadLink;
    }

    public function setDownloadLink(string $DownloadLink): self
    {
        $this->DownloadLink = $DownloadLink;

        return $this;
    }

    public function getNbDownload(): ?int
    {
        return $this->nbDownload;
    }

    public function setNbDownload(int $nbDownload): self
    {
        $this->nbDownload = $nbDownload;

        return $this;
    }
    public function getSalt()
    {
        // you may need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->identifier,
            $this->pseudo,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->identifier,
            $this->pseudo,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
 
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }
    public function getUsername()
    {
        return $this->pseudo;
    }

}

