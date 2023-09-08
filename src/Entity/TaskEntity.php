<?php

namespace App\Entity;

use App\Repository\TaskEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskEntityRepository::class)]
class TaskEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateOfCreate = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deadline = null;

    #[ORM\ManyToMany(targetEntity: ClientEntity::class, mappedBy: 'tasks')]
    private Collection $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDateOfCreate(): ?\DateTimeImmutable
    {
        return $this->dateOfCreate;
    }

    public function setDateOfCreate(\DateTimeImmutable $dateOfCreate): static
    {
        $this->dateOfCreate = $dateOfCreate;

        return $this;
    }

    public function getDeadline(): ?\DateTimeImmutable
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeImmutable $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    /**
     * @return Collection<int, ClientEntity>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(ClientEntity $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->addTask($this);
        }

        return $this;
    }

    public function removeClient(ClientEntity $client): static
    {
        if ($this->clients->removeElement($client)) {
            $client->removeTask($this);
        }

        return $this;
    }
}
