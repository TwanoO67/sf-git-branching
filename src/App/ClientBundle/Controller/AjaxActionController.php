<?php

namespace App\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxActionController extends Controller
{

    //ensemble des actions possibles depuis un appel ajax
    public function ajaxAction(Request $request)
    {
      $retour = array();
      $retour['code'] = 'error';
      $retour['data'] = '';

      //parametres possibles
      $action = $request->request->get('action');
      $repo_path = $request->request->get('repo_path');
      $branche = $request->request->get('branche');
      $value = $request->request->get('value');

      $retour['repo_path'] = $repo_path;

      $repository = $this->getDoctrine()->getRepository('AppServerBundle:Depot\Repository');
      $repo = $repository->findOneByPath($repo_path);

      if($repo){
          $retour['code'] = 'error';
          $current_repo = $repo->getGitRepo();

          switch($action){
              case "log":
                  foreach($current_repo->getLog() as $commit){
                    $retour['data'] .= '<span style="color:blue">'.$commit->getDatetimeAuthor()->format('d/m/Y').'</span>';
                    $retour['data'] .= ' - ';
                    $retour['data'] .= '<span style="color:red">'.$commit->getAuthor()."</span>";
                    $retour['data'] .= ' - ';
                    $retour['data'] .= '<i><span style="color:green">'.$commit->getMessage()."</i></span> <br/>\n";
                  }
                  $retour['code'] = "ok";
                  break;
              case "pull":
                  $current_repo->pull();
                  $retour['data'] = $current_repo->getCaller()->getOutput();
                  $retour['code'] = "ok";
                  break;
              case "checkout":
                  $current_repo->checkout($branche);
                  $retour['data'] = $current_repo->getCaller()->getOutput();
                  $retour['code'] = "ok";
                  break;
              case "fetch":
                  $current_repo->fetch();
                  $retour['data'] = $current_repo->getCaller()->getOutput();
                  $retour['code'] = "ok";
                  break;
              case "autopuller":
                  $repo->setAutoPuller($value);
                  $retour['code'] = "ok";
                  break;
              case "delete":
                  $current_repo->deleteBranch($branche);
                  $retour['data'] = $current_repo->getCaller()->getOutput();
                  $retour['code'] = "ok";
                  break;
          }


      }
      else{
          $retour['data'] = 'Dépot inexistant: '.$repo_path;
      }

     return new Response(json_encode($retour));
    }

}
