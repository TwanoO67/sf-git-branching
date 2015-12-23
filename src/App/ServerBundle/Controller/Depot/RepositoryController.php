<?php

namespace App\ServerBundle\Controller\Depot;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\ServerBundle\Entity\Depot\Repository;
use App\ServerBundle\Form\Depot\RepositoryType;

/**
 * Depot\Repository controller.
 *
 * @Route("/admin/repo")
 */
class RepositoryController extends Controller
{

    /**
     * Lists all Depot\Repository entities.
     *
     * @Route("/", name="admin_repo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppServerBundle:Depot\Repository')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Depot\Repository entity.
     *
     * @Route("/", name="admin_repo_create")
     * @Method("POST")
     * @Template("AppServerBundle:Depot\Repository:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Repository();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_repo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Depot\Repository entity.
     *
     * @param Repository $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Repository $entity)
    {
        $form = $this->createForm(new RepositoryType(), $entity, array(
            'action' => $this->generateUrl('admin_repo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Depot\Repository entity.
     *
     * @Route("/new", name="admin_repo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Repository();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Depot\Repository entity.
     *
     * @Route("/{id}", name="admin_repo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppServerBundle:Depot\Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Depot\Repository entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Depot\Repository entity.
     *
     * @Route("/{id}/edit", name="admin_repo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppServerBundle:Depot\Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Depot\Repository entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Depot\Repository entity.
    *
    * @param Repository $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Repository $entity)
    {
        $form = $this->createForm(new RepositoryType(), $entity, array(
            'action' => $this->generateUrl('admin_repo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Depot\Repository entity.
     *
     * @Route("/{id}", name="admin_repo_update")
     * @Method("PUT")
     * @Template("AppServerBundle:Depot\Repository:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppServerBundle:Depot\Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Depot\Repository entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_repo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Depot\Repository entity.
     *
     * @Route("/{id}", name="admin_repo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppServerBundle:Depot\Repository')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Depot\Repository entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_repo'));
    }

    /**
     * Creates a form to delete a Depot\Repository entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_repo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
