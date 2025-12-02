<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $nom;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    private ?string $email;

    #[Assert\NotBlank()]
    private ?string $message;

    function getNom(): ?string
    {
        return $this->nom;
    }

    function getEmail(): ?string
    {
        return $this->email;
    }

    function getMessage(): ?string
    {
        return $this->message;
    }

    function setNom($nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    function setMessage($message): self
    {
        $this->message = $message;
        return $this;
    }
}
