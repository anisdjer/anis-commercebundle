<?php

namespace Anis\CommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Anis\CommerceBundle\Entity\LigneFacture;
use Anis\CommerceBundle\Form\LigneFactureType;

/**
 * LigneFacture controller.
 *
 * @Route("/lignefacture")
 */
class LigneFactureController extends Controller
{

    /**
     * Lists all LigneFacture entities.
     *
     * @Route("/", name="lignefacture")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnisCommerceBundle:LigneFacture')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new LigneFacture entity.
     *
     * @Route("/", name="lignefacture_create")
     * @Method("POST")
     * @Template("AnisCommerceBundle:LigneFacture:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new LigneFacture();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lignefacture_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a LigneFacture entity.
    *
    * @param LigneFacture $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(LigneFacture $entity)
    {
        $form = $this->createForm(new LigneFactureType(), $entity, array(
            'action' => $this->generateUrl('lignefacture_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new LigneFacture entity.
     *
     * @Route("/new", name="lignefacture_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new LigneFacture();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a LigneFacture entity.
     *
     * @Route("/{id}", name="lignefacture_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:LigneFacture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LigneFacture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing LigneFacture entity.
     *
     * @Route("/{id}/edit", name="lignefacture_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:LigneFacture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LigneFacture entity.');
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
    * Creates a form to edit a LigneFacture entity.
    *
    * @param LigneFacture $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LigneFacture $entity)
    {
        $form = $this->createForm(new LigneFactureType(), $entity, array(
            'action' => $this->generateUrl('lignefacture_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing LigneFacture entity.
     *
     * @Route("/{id}", name="lignefacture_update")
     * @Method("PUT")
     * @Template("AnisCommerceBundle:LigneFacture:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:LigneFacture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LigneFacture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lignefacture_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a LigneFacture entity.
     *
     * @Route("/{id}", name="lignefacture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnisCommerceBundle:LigneFacture')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find LigneFacture entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lignefacture'));
    }

    /**
     * Creates a form to delete a LigneFacture entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lignefacture_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
