<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class UserRecoverEmail implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "L'adresse email '{{ value }}' n'est pas une adresse valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":false})
     */
    private $validEmail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 8,
     *      max = 16,
     *      minMessage = "Le mot de passe doit contenir au minimum {{ limit }} caractères",
     *      maxMessage = "Le mot de passe doit contenir au maximum {{ limit }} caractères"
     * )
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Le mot de passe n'est pas identique")
     */
    public $confirmPassword;


    /**
     * @ORM\Column(type="datetime")
     */
    private $registerDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $module;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $accessLevel;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $emailSecurityKey;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegisterDate(): ?\DateTimeInterface
    {
        return $this->registerDate;
    }

    public function setRegisterDate(\DateTimeInterface $registerDate): self
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getAccessLevel(): ?string
    {
        return $this->accessLevel;
    }

    public function setAccessLevel(string $accessLevel): self
    {
        $this->accessLevel = $accessLevel;

        return $this;
    }

    public function eraseCredentials(){
    }

    public function getSalt(){
    }

    public function getRoles(){
               
        $listRoles = $this->accessLevel;
        $roles = explode(';', $listRoles);
        return $roles;
    }

    public function getValidEmail(): ?bool
    {
        return $this->validEmail;
    }

    public function setValidEmail(bool $validEmail): self
    {
        $this->validEmail = $validEmail;

        return $this;
    }

    public function getEmailSecurityKey()
    {
        return $this->emailSecurityKey;
    }

    public function setEmailSecurityKey($emailSecurityKey): self
    {
        $this->emailSecurityKey = $emailSecurityKey;

        return $this;
    }
}
    