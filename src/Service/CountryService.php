<?php
namespace App\Service;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;

class CountryService {
    private EntityManagerInterface $entityManager;
    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function ajouterCountry(Country $country) {
        // indique à Doctrine que l'on souhaite enregistrer le country
        $this->entityManager->persist($country);
        // exécute la requête (INSERT query)
        $this->entityManager->flush();
    }

    public function recupererCountry($id) {
        // récupère le country avec sont id
        return $this->entityManager->getRepository(Country::class)->find($id);
    }

    public function modifierCountry(Country $country) {
        $this->entityManager->persist($country);
        $this->entityManager->flush();
    }

    public function supprimerCountry(Country $country) {
        // indique à Doctrine que l'on souhaite supprimer le country
        $this->entityManager->remove($country);
        // exécute la requête (DELETE query)
        $this->entityManager->flush();
    }

     public function afficheCountry() {
        // récupère tous les pays
        return $this->entityManager->getRepository("App\Entity\Country")->findAll();
    }
}