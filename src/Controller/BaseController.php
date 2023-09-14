<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/base')]
class BaseController extends AbstractController
{
    /**
     * @return Response
     * Attribut de route: définit quel l'url sur lequel on accède à la méthode
     * les simples quotes sont obligatoires
     * ici pour accéder à cette méthode mon url devra être:
     * http://localhost:8000/base car la classe de controller possède une annotation de route /base
     */
    #[Route('/', name: 'app_base')]
    public function index(): Response
    {

        // La méthode render est une méthode de l'Abstract controller qui attend en 1er paramètre obligatoire,
        //  l'emplacement du fichier de template à partir du dossier templates avec l'extension du fichier. Et en second paramètre optionnel un tableau permettant de faire transiter des données du controller au twig
        // ici on envoi au twig une variable que l'on nomme  'controller_name' et qui aura pour valeur, une fois interpollé dans le twig 'BaseController'
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

//   /**
//    * avant php8 système d'annotation
//    * @Route("/", name="app_base")
//    */
//    public function index(): Response
//    {
//        return $this->render('base/index.html.twig', [
//            'controller_name' => 'BaseController',
//        ]);
//    }
//

    /**
     * @return Response
     * Partie variable de l'url entre accolade
     * /base/hello/toto   ou /base/hello/cesaire   toutes deux fonctionneront
     *
     * ici en l'absence de name sur la route, le name généré par défaut sera: app_base_hello
     *
     * $qui injecté en paramètre de la méthode recevra la valeur de la partie variable
     */
    #[Route('/hello/{qui}')]
    public function hello($qui): Response
    {


        return $this->render('base/hello.html.twig', [
            "nom" => $qui
        ]);
    }


    #[Route('/salut/{qui}' , name: 'salut')]
    public function salut($qui="A toi"): Response
    {



        return $this->render('base/salut.html.twig', [
            "nom" => $qui
        ]);
    }


    /**
     * @param $nom
     * @param $prenom
     * @return Response
     * 2 parties variables dans l'url dont une optionnelle
     */
      #[Route('/coucou/{prenom}/{nom}',defaults:['nom'=>'' ], name: 'coucou')]
          public function coucou($nom, $prenom): Response
          {
             $nomComplet=$prenom.' '.$nom;

              return $this->render('base/coucou.html.twig', [
                "nom"=>$nomComplet
              ]);
          }


            #[Route('/editUser/{id}', requirements: ['id'=>"\d+"], name: 'editUser')]
                public function editUser(): Response
                {


                    return $this->render('base/editUser.html.twig', [

                    ]);
                }




}
