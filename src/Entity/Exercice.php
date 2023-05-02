<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    #[Assert\Length(min: 3, max: 255,
        minMessage: 'Votre nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre nom ne doit pas dépasser {{ limit }} caractères')]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?Seance $seance = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(min: 1, max: 500,
        minMessage: 'Votre description doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre description ne doit pas dépasser {{ limit }} caractères')]
    private ?string $description = null;

    #[ORM\Column(length: 5, nullable: false)]
    #[Assert\Positive(message: 'La valeur doit être positive et au miminum égale à 1')]
    #[Assert\NotBlank(message: 'Le nombre de série doit être d\'au moins 1')]
    #[Assert\Type(type: 'int', message: 'La valeur doit être un nombre')]
    #[Assert\Length(min: 1, max: 5,
        minMessage: 'Votre série doit contenir au moins {{ limit }} séries',
        maxMessage: 'Votre série ne doit pas dépasser {{ limit }} caractères')]
    private ?int $serie = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Assert\Positive(message: 'La valeur doit être positive et au miminum égale à 1')]
    #[Assert\Type(type: 'int', message: 'La valeur doit être un nombre')]
    #[Assert\Length(min: 1, max: 5,
        minMessage: 'Votre répétition doit contenir au moins {{ limit }} répétitions',
        maxMessage: 'Votre répétition ne doit pas dépasser {{ limit }} caractères')]
    private ?int $repetition = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Assert\Positive(message: 'La valeur doit être positive et au miminum égale à 1')]
    #[Assert\Type(type: 'int', message: 'La valeur doit être un nombre')]
    #[Assert\Length(max: 5,
        maxMessage: 'Votre temps ne doit pas dépasser {{ limit }} caractères')]
    private ?int $temps = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Assert\Positive(message: 'La valeur doit être positive et au miminum égale à 1')]
    #[Assert\Type(type: 'int', message: 'La valeur doit être un nombre')]
    #[Assert\Length(max: 5,
        maxMessage: 'Votre temps de récupération ne doit pas dépasser {{ limit }} caractères')] 
    private ?int $recuperation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255,
        maxMessage: 'Votre image ne doit pas dépasser {{ limit }} caractères')]
    private ?string $picture = null;

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

    public function getSerie(): ?int
    {
        return $this->serie;
    }

    public function setSerie(?int $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(?int $repetition): self
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->temps;
    }

    public function setTemps(?int $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getRecuperation(): ?int
    {
        return $this->recuperation;
    }

    public function setRecuperation(int $recuperation): self
    {
        $this->recuperation = $recuperation;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
