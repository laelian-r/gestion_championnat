<?php
namespace App\Service;

use App\Entity\Championship;
use Doctrine\ORM\EntityManagerInterface;

class ChampionshipService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function ajouterChampionship(Championship $championship)
    {
        // indique à Doctrine que l'on souhaite enregistrer le championship
        $this->entityManager->persist($championship);
        // exécute la requête (INSERT query)
        $this->entityManager->flush();
    }

    public function recupererChampionship($id)
    {
        // récupère le championship avec son id
        return $this->entityManager
            ->getRepository(Championship::class)
            ->find($id);
    }

    public function modifierChampionship(Championship $championship)
    {
        $this->entityManager->persist($championship);
        $this->entityManager->flush();
    }

    public function supprimerChampionship(Championship $championship)
    {
        // indique à Doctrine que l'on souhaite supprimer le championship
        $this->entityManager->remove($championship);
        // exécute la requête (DELETE query)
        $this->entityManager->flush();
    }

    public function afficheChampionship()
    {
        // récupère tous les championship
        return $this->entityManager
            ->getRepository(Championship::class)
            ->findAll();
    }
}
