<?php
namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Team;
use App\Service\ChampionshipService;
use App\Form\ChampionshipFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ChampionshipController extends AbstractController
{
    /* sans formulaire */
    #[Route('/ajouter_championnat', name: 'ajouter_championnat')]
    public function createChampionship(ChampionshipService $championshipService): Response
    {
        $championship = new Championship();
        $championshipService->ajouterChampionship($championship);

        return new Response('Ajout du championship avec id '.$championship->getId());
    }

    #[Route("/insert_championnat", name: "add_championship")]
    public function insert(Request $request, ChampionshipService $service): RedirectResponse|Response {
        $championship = new Championship();
        $form = $this->createForm(ChampionshipFormType::class, $championship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service->ajouterChampionship($championship);
            return $this->redirectToRoute('affiche_championnats');
        }

        return $this->render('championship/new_championship.html.twig', [
            'championshipForm' => $form,
            'titre' => 'Ajouter un championnat'
        ]);
    }

    // #[Route("/insert_championnat", name: "add_championship")]
    // public function insert(Request $request, ChampionshipService $service): RedirectResponse|Response {
    //     $championship = new Championship();
    //     $form = $this->createForm(ChampionshipFormType::class, $championship);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $service->ajouterProduit($championship);
    //         return $this->redirectToRoute('affiche_championnats');
    //     }

    //     return $this->render('championship/new_championship.html.twig', [
    //         'championshipForm' => $form,
    //         'titre' => 'Ajouter un championnat'
    //     ]);
    // }

    #[Route("/update_championship/{id}", name: "update_championship")]
    public function update(
        Request $request,
        ChampionshipService $service,
        int $id
    ): RedirectResponse|Response {
        $championship = $service->recupererChampionship($id);

        if (!$championship) {
            return $this->redirectToRoute('add_championship');
        }

        $form = $this->createForm(ChampionshipFormType::class, $championship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Le formulaire a déjà modifié l'objet $championship automatiquement
            // Il suffit juste de persister les changements
            $service->modifierChampionship($championship);
            return $this->redirectToRoute('affiche_championnats');
        }

        return $this->render('championship/update_championship.html.twig', [
            'championshipForm' => $form,
            'championship' => $championship,
            'titre' => 'Modifier le championnat'
        ]);
    }

    #[Route('/supprimer_championship/{id}', name: 'supprimer_championship')]
    public function deleteChampionship(
        ChampionshipService $service,
        int $id
    ): RedirectResponse {
        $championship = $service->recupererChampionship($id);

        if ($championship) {
            $service->supprimerChampionship($championship);
        } else {
            $this->addFlash('error', 'Le championship n\'a pas pu être supprimé.');
        }

        return $this->redirectToRoute('affiche_championnats');
    }

    #[Route('/affiche_championnats', name: 'affiche_championnats')]
    public function afficheChampionship(
        ChampionshipService $service
    ): Response {
        $championship = $service->afficheChampionship();

        return $this->render('championship/championship.html.twig', [
            'championship' => $championship,
            'titre' => 'Liste des championnats'
        ]);
    }
}