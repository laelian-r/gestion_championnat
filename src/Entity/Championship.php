<?php

namespace App\Entity;

use App\Repository\ChampionshipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionshipRepository::class)]
class Championship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $endDate = null;

    #[ORM\Column]
    private ?int $wonPoint = null;

    #[ORM\Column]
    private ?int $lostPoint = null;

    #[ORM\Column]
    private ?int $drawPoint = null;

    #[ORM\Column(length: 255)]
    private ?string $typeRanking = null;

    // #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: "championship",cascade: ['persist'])]
    // #[ORM\JoinColumn(name: 'team_id', referencedColumnName: 'id')]
    // private ?Team $team = null;

    // Tous vos getters et setters existants...
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


    // public function getTeam(): ?Team
    // {
    //     return $this->team;
    // }
    
    // public function setTeam(?Team $team): static
    // {
    //     $this->team = $team;

    //     return $this;
    // }
}