<?php

namespace App\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\ClientBundle\Service;
use GitElephant\Repository;

class AppController extends Controller
{
  public function homeAction()
  {
    $common = $this->container->get('common');
    $test = $common->getTest();


    $repo = new Repository('/Users/TwanoO/Documents/PERSO/GIT/sf-git-branch');

    return $this->render('AppClientBundle:Page:home.html.twig', array(
      'title' => 'Title from Symfony',
      'status' => $repo->getStatusOutput()
    ));
  }
}
