<?php

declare(strict_types=1);

namespace Descarga\Subscriber\Entity;

use Descarga\Subscriber\Repository\SubscriberPostgresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriberPostgresRepository::class)]
class Subscriber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int | null $id = null;

    public function __construct(
        #[ORM\Column(type: 'string', length: 255)]
        protected string $firstName,
        #[ORM\Column(type: 'string', length: 255)]
        protected string $lastName,
        #[ORM\Column(type: 'string', length: 255)]
        protected string $email
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
