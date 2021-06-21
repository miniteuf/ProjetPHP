<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Pseudo;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $Email;

    /**
     * @ORM\Column(type="text")
     */
    private $Password;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(
     *     min = 5,
     *     max = 20,
     *     minMessage = "Ton mot de passe doit faire au minimum {{ limit }} characters (PD).",
     *     maxMessage = "Ton mot de passe ne doit pas dépasser {{ limit }} characters."
     * )
     * @Assert\NotEqualTo(
     *     propertyPath = "pseudo",
     *     message = "ton mot de passe ne peut pas être ton email."
     * )
     * @Assert\NotBlank(groups={"registration"})
     */
    private $plainPassword;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setID(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): self
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

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
            $this->id,
            $this->Pseudo,
            $this->Password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->Pseudo,
            $this->Password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
 
    public function setPlainPassword($Password)
    {
        $this->plainPassword = $Password;
    }
    public function getUsername()
    {
        return $this->Pseudo;
    }

}

