<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\CreateGameFormType;
use App\Repository\GameRepository;
use Symfony\Component\Form\AbstractType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GamesController extends AbstractController
{

    public function index(Request $request, PaginatorInterface $paginator):Response
    {
        $em = $this->getDoctrine()->getManager();

        $listGames = $em->getRepository(Game::class)
        ->findAll();
        $listGamesPagination = $paginator->paginate(
            $listGames, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        return $this->render('game/game.html.twig', array(
            'listGames' => $listGamesPagination,
            ));
                                                             
    } 




    
}