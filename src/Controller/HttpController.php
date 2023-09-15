<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HttpController extends AbstractController
{

    #[Route('/http', name: 'app_http')]
    public function index(): Response
    {
        return $this->render('http/index.html.twig', [
            'controller_name' => 'HttpController',
        ]);
    }


    #[Route('/request', name: 'request')]   // ici on injecte en dépendance la classe Request de HttpFoundation instanciée dans l'objet $request
    public function request(Request $request): Response
    {


        // Request permet de récupérer les données provenant des superglobale (principalement pour $_POST, $_GET, $_COOKIES)

        //http://localhost:8000/request?nom=desaulle&prenom=cesaire
        dump($_GET);

        dump($request);

          // $request->query contient un objet qui est une surcouche de $_GET


        //  var_dump($_GET)
        //dd($request->query->all());

        // echo $_GET['prenom']
        echo $request->query->get('prenom');

        // isset($_GET['surnom'])
        dump($request->query->has('surnom')); // false

        dump($request->query->get('surnom')); // null sans erreur

        dump($request->query->get('surnom', 'toto'));//  toto car déclaré comme valeur par defaut
        //echo $_GET['surnom'];  warning:undefined variable surnom

        dump($request->getMethod());// renvoie la méthode utilisée

        // si on est en méthode post le code suivant s'execute
        if ($request->isMethod('POST')){

            dump($request->request->all());
        }

        // ces mêmes méthodes s'appliquent de même sur l'objet $request->request qui contient une surcouche de $_POST





        return $this->render('http/request.html.twig', [

        ]);
    }




}
