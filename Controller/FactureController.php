<?php

namespace Anis\CommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Anis\CommerceBundle\Entity\Facture;
use Anis\CommerceBundle\Form\FactureType;

/**
 * Facture controller.
 *
 * @Route("/facture")
 */
class FactureController extends Controller
{

    /**
     * Lists all Facture entities.
     *
     * @Route("/{page}", name="facture1", requirements={"page" = "\d+"})
     * @Route("/", name="facture")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($page = 1)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnisCommerceBundle:Facture')->findAllLimited($page);


        $query = $em->createQuery('SELECT COUNT(u.id) FROM AnisCommerceBundle:Facture u');
        $count = $query->getSingleScalarResult();

        return array(
            'entities' => $entities,
            'page' => $page,
            'pages' => ($count - ($count % 10) ) / 10 + 1
        );
    }

    /**
     * Search for clients by criteria.
     *
     * @Route("/search", name="facture_search")
     * @Method("POST")
     */
    public function searchAction(Request $request)
    {

        //die(var_dump($request->request));
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AnisCommerceBundle:Facture')->getListBy($request->request->all());
        $clients = array();
        foreach($query as $client){
            $clientArray = $client->toArray();
            $clientArray["showURL"] = $this->generateUrl("client_show", array('id' => $client->getId()));
            $clientArray["editURL"] = $this->generateUrl("client_edit", array('id' => $client->getId()));
            $clientArray["deleteURL"] = $this->generateUrl("client_delete", array('id' => $client->getId()));

            $clients[] = $clientArray;
        }
        //die(var_dump($query));
        $response = new Response(json_encode($clients));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Creates a new Facture entity.
     *
     * @Route("/", name="facture_create")
     * @Method("POST")
     * @Template("AnisCommerceBundle:Facture:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Facture();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facture_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Facture entity.
     *
     * @param Facture $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Facture $entity)
    {
        $form = $this->createForm(new FactureType(), $entity, array(
            'action' => $this->generateUrl('facture_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Facture entity.
     *
     * @Route("/new", name="facture_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Facture();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Facture entity.
     *
     * @Route("/{id}", name="facture_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Facture entity.
     *
     * @Route("/{id}/edit", name="facture_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
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
     * Creates a form to edit a Facture entity.
     *
     * @param Facture $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Facture $entity)
    {
        $form = $this->createForm(new FactureType(), $entity, array(
            'action' => $this->generateUrl('facture_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Facture entity.
     *
     * @Route("/{id}", name="facture_update")
     * @Method("PUT")
     * @Template("AnisCommerceBundle:Facture:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('facture_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Facture entity.
     *
     * @Route("/{id}", name="facture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facture entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('facture'));
    }

    /**
     * Creates a form to delete a Facture entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facture_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }
}
