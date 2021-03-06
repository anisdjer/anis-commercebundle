<?php

namespace Anis\CommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Anis\CommerceBundle\Entity\Produit;
use Anis\CommerceBundle\Form\ProduitType;

/**
 * Produit controller.
 *
 * @Route("/produit")
 */
class ProduitController extends Controller
{

    /**
     * Lists all Produit entities.
     *
     * @Route("/{page}", name="produit1", requirements={"page" = "\d+"})
     * @Route("/", name="produit")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($page = 1)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnisCommerceBundle:Produit')->findAllLimited($page);


        $query = $em->createQuery('SELECT COUNT(u.id) FROM AnisCommerceBundle:Produit u');
        $count = $query->getSingleScalarResult();

        /*$html = $this->renderView('AnisCommerceBundle:Produit:index.html.twig',
            array('entities' => $entities,
                'page' => $page,
                'pages' => ($count - ($count % 10) ) / 10 + 1
            ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf'

            ));*/

        return array(
            'entities'  => $entities,
            'page' => $page,
            'pages' => (($count - 1)  - (($count - 1) % 10) ) / 10 + 1
        );
    }

    /**
     * Search for products by criteria.
     *
     * @Route("/search", name="produit_search")
     * @Method("POST")
     */
    public function searchAction(Request $request)
    {
        //die(var_dump($request->request));
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AnisCommerceBundle:Produit')->getListBy($request->request->all());
        $produits = array();
        foreach($query as $produit){

            $produitArray = $produit->toArray();
//            $produitArray["showURL"] = $this->generateUrl("produit_show", array('id' => $produit->getId()));
            $produitArray["editURL"] = $this->generateUrl("produit_edit", array('id' => $produit->getId()));
            $produitArray["deleteURL"] = $this->generateUrl("produit_delete", array('id' => $produit->getId()));

            $produits[] = $produitArray;
        }
        //die(var_dump($query));
        $response = new Response(json_encode($produits));

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Creates a new Produit entity.
     *
     * @Route("/", name="produit_create")
     * @Method("POST")
     * @Template("AnisCommerceBundle:Produit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Produit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('produit'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Produit entity.
    *
    * @param Produit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Produit $entity)
    {
        $form = $this->createForm(new ProduitType(), $entity, array(
            'action' => $this->generateUrl('produit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Produit entity.
     *
     * @Route("/new", name="produit_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Produit();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Displays a form to edit an existing Produit entity.
     *
     * @Route("/{id}/edit", name="produit_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:Produit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produit entity.');
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
    * Creates a form to edit a Produit entity.
    *
    * @param Produit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Produit $entity)
    {
        $form = $this->createForm(new ProduitType(), $entity, array(
            'action' => $this->generateUrl('produit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Produit entity.
     *
     * @Route("/{id}", name="produit_update")
     * @Method("PUT")
     * @Template("AnisCommerceBundle:Produit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnisCommerceBundle:Produit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Produit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('produit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Produit entity.
     *
     * @Route("/{id}", name="produit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnisCommerceBundle:Produit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Produit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('produit'));
    }

    /**
     * Creates a form to delete a Produit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
