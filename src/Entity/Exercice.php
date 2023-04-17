<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?Seance $seance = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $serie = null;

    #[ORM\Column(nullable: true)]
    private ?float $repetition = null;

    #[ORM\Column(nullable: true)]
    private ?float $temps = null;

    #[ORM\Column]
    private ?float $recuperation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): self
    {
        $this->seance = $seance;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSerie(): ?float
    {
        return $this->serie;
    }

    public function setSerie(?float $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getRepetition(): ?float
    {
        return $this->repetition;
    }

    public function setRepetition(?float $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getTemps(): ?float
    {
        return $this->temps;
    }

    public function setTemps(?float $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getRecuperation(): ?float
    {
        return $this->recuperation;
    }

    public function setRecuperation(float $recuperation): self
    {
        $this->recuperation = $recuperation;

        return $this;
    }
}
