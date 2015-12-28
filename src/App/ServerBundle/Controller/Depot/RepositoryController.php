<?php

namespace App\ServerBundle\Controller\Depot;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\ServerBundle\Entity\Depot\Repository;
use App\ServerBundle\Form\Depot\RepositoryType;

/**
 * Depot\Repository controller.
 *
 */
class RepositoryController extends Controller
{

    /**
     * Lists all Depot\Repository entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppServerBundle:Depot\Repository')->findAll();

        return $this->render('AppServerBundle:Depot/Repository:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Depot\Repository entity.
     *
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

            return $this->redirect($this->generateUrl('admin_depot_show', array('id' => $entity->getId())));
        }

        return $this->render('AppServerBundle:Depot/Repository:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
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
            'action' => $this->generateUrl('admin_depot_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Depot\Repository entity.
     *
     */
    public function newAction()
    {
        $entity = new Repository();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppServerBundle:Depot/Repository:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Depot\Repository entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppServerBundle:Depot\Repository')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Depot\Repository entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppServerBundle:Depot/Repository:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Depot\Repository entity.
     *
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

        return $this->render('AppServerBundle:Depot/Repository:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
            'action' => $this->generateUrl('admin_depot_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Depot\Repository entity.
     *
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

            return $this->redirect($this->generateUrl('admin_depot_edit', array('id' => $id)));
        }

        return $this->render('AppServerBundle:Depot/Repository:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Depot\Repository entity.
     *
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

        return $this->redirect($this->generateUrl('admin_depot'));
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
            ->setAction($this->generateUrl('admin_depot_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
