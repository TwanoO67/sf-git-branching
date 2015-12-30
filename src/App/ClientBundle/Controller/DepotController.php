<?php

namespace App\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DepotController extends Controller
{

    public function listAction()
    {
      $repository = $this->getDoctrine()->getRepository('AppServerBundle:Depot\Repository');

      return $this->render('AppClientBundle:Depot:list.html.twig', array(
        'depots' => $repository->findAll()
      ));

    }

    public function showAction($id){
      $repository = $this->getDoctrine()->getRepository('AppServerBundle:Depot\Repository');
      $repo = $repository->find($id);

      return $this->render('AppClientBundle:Depot:index.html.twig', array(
        'title' => 'index du depot',
        'repo' => $repo,
        'gitrepo' => $repo->getGitRepo()
      ));
    }

}
