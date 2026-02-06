<?php
namespace App\Controller;

use App\Entity\Country;
use App\Entity\Team;
use App\Service\CountryService;
use App\Form\CountryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CountryController extends AbstractController
{
    /* sans formulaire */
    #[Route('/ajouter_country', name: 'ajouter_country')]
    public function createCountry(CountryService $countryService): Response
    {
        $country = new Country();
        // $country->setNom('France');
        // $country->setCode('FR');
        $countryService->ajouterCountry($country);
        return new Response('Ajout du country avec id '.$country->getId());

        $team = new Team();
        $team->setChampionship($team);
        $teamService->ajouterTeam($team);
        return new Response('Ajout du team avec id '.$team->getId());
    }

    //avec formulaire
    #[Route("/insert_pays", name: "add_country")]
    public function insert(Request $request, CountryService $service, EntityManagerInterface $entityManager): RedirectResponse|Response {
        $country = new Country();
        $form = $this->createForm(CountryFormType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $teamName = $form->get('team_name')->getData();
            
            // Chercher ou créer la Team
            $teamRepository = $entityManager->getRepository(Team::class);
            $team = $teamRepository->findOneBy(['name' => $teamName]);
            
            if (!$team) {
                $team = new Team();
                $team->setName($teamName);
                $team->setCreationDate($form->get('team_creation_date')->getData());
                $team->setStade($form->get('team_stade')->getData());
                $team->setPresident($form->get('team_president')->getData());
                $team->setCoach($form->get('team_coach')->getData());
                
                // Gérer le logo (fichier uploadé)
                $logoFile = $form->get('team_logo')->getData();
                if ($logoFile) {
                    $newFilename = uniqid().'.'.$logoFile->guessExtension();
                    
                    try {
                        $logoFile->move(
                            $this->getParameter('kernel.project_dir') . '/public/images',
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // Gérer l'erreur d'upload
                        $this->addFlash('error', 'Erreur lors de l\'upload du logo');
                        return $this->redirectToRoute('add_country');
                    }
                    
                    $team->setLogo($newFilename);
                } else {
                    // Si pas de fichier malgré required=true, erreur
                    $this->addFlash('error', 'Le logo est obligatoire');
                    return $this->render('country/new_country.html.twig', [
                        'countryForm' => $form,
                        'titre' => 'Bienvenue à tous'
                    ]);
                }
                
                $entityManager->persist($team);
            }
            
            // Associer la Team au Country
            $country->setChampionship($team);
            
            $service->ajouterCountry($country);
            return $this->redirectToRoute('affiche_country');
        }

        return $this->render('country/new_country.html.twig', [
            'countryForm' => $form,
            'titre' => 'Bienvenue à tous'
        ]);
    }

    #[Route('/modifier_pays', name: 'modifier_country')]
    public function updateCountry(CountryService $countryService): Response {
        // récupère le country suivant son id
        $country = $countryService->recupererCountry(2);
        // modifie le country
        $country->setNom('Allemagne');
        $countryService->modifierCountry($country);
        return new Response('Modification du country avec id '.$country->getId());
    }

    #[Route("/update_pays/{id}", name: "update_country")]
    public function update(Request $request, CountryService $service, EntityManagerInterface $entityManager, int $id): RedirectResponse|Response {
        $country = $service->recupererCountry($id);
        if(!$country) {
            return $this->redirectToRoute('add_country');
        }
        
        $form = $this->createForm(CountryFormType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $teamName = $form->get('team_name')->getData();
            
            // Chercher ou créer la Team
            $teamRepository = $entityManager->getRepository(Team::class);
            $team = $teamRepository->findOneBy(['name' => $teamName]);
            
            if (!$team) {
                // Créer une nouvelle équipe
                $team = new Team();
                $team->setName($teamName);
                $team->setCreationDate($form->get('team_creation_date')->getData());
                $team->setStade($form->get('team_stade')->getData());
                $team->setPresident($form->get('team_president')->getData());
                $team->setCoach($form->get('team_coach')->getData());
                
                // Gérer le logo
                $logoFile = $form->get('team_logo')->getData();
                if ($logoFile) {
                    $newFilename = uniqid().'.'.$logoFile->guessExtension();
                    
                    try {
                        $logoFile->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads/logos',
                            $newFilename
                        );
                        $team->setLogo($newFilename);
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors de l\'upload du logo');
                    }
                }
                
                $entityManager->persist($team);
            } else {
                // Mettre à jour l'équipe existante
                if ($form->get('team_creation_date')->getData()) {
                    $team->setCreationDate($form->get('team_creation_date')->getData());
                }
                if ($form->get('team_stade')->getData()) {
                    $team->setStade($form->get('team_stade')->getData());
                }
                if ($form->get('team_president')->getData()) {
                    $team->setPresident($form->get('team_president')->getData());
                }
                if ($form->get('team_coach')->getData()) {
                    $team->setCoach($form->get('team_coach')->getData());
                }
                
                // Gérer le logo (SEULEMENT si un nouveau fichier est uploadé)
                $logoFile = $form->get('team_logo')->getData();
                if ($logoFile) {
                    // Supprimer l'ancien logo
                    $oldLogo = $team->getLogo();
                    if ($oldLogo) {
                        $oldLogoPath = $this->getParameter('kernel.project_dir') . '/public/uploads/logos/' . $oldLogo;
                        if (file_exists($oldLogoPath)) {
                            unlink($oldLogoPath);
                        }
                    }
                    
                    // Upload du nouveau logo
                    $newFilename = uniqid().'.'.$logoFile->guessExtension();
                    
                    try {
                        $logoFile->move(
                            $this->getParameter('kernel.project_dir') . '/assets/images',
                            $newFilename
                        );
                        $team->setLogo($newFilename);
                    } catch (FileException $e) {
                        $this->addFlash('error', 'Erreur lors de l\'upload du logo');
                    }
                }
            }
            
            // Associer la Team au Country
            $country->setChampionship($team);
            
            $service->modifierCountry($country);
            return $this->redirectToRoute('affiche_country');
        }

        return $this->render('country/update_country.html.twig', [
            'countryForm' => $form,
            'country' => $country,
            'titre' => 'Modifier le pays'
        ]);
    }

    #[Route('/supprimer_pays/{id}', name: 'supprimer_country')]
    public function deleteCountry(CountryService $countryService, int $id): Response {
        // récupère le country suivant son id
        //$country = $countryService->recupererCountry(1);
        $country = $countryService->recupererCountry($id);
        if(!$country) {
            $this->addFlash('error', 'Le pays n\'a pas pu être supprimé.');
        } else {
            // supprime le country
            $countryService->supprimerCountry($country);
        }
       // return new Response('Suppression du country');
        return $this->redirectToRoute('affiche_country');
    }

    #[Route('/affiche_pays', name: 'affiche_country')]
    public function afficheCountries(CountryService $countryService): Response {
        $countries = $countryService->afficheCountry();
        //return new Response('Affiche les pays');
        return $this->render('country/country.html.twig', [
            "countries" => $countries,
            "titre" => "Liste des pays"
        ]);
    }
}