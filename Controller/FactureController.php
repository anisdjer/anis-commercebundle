<?php

namespace Anis\CommerceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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

        /*$html = $this->renderView('AnisCommerceBundle:Facture:index.html.twig',
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
            'entities' => $entities,
            'page' => $page,
            'pages' => (($count - 1)  - (($count - 1) % 10) ) / 10 + 1
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
            $clientArray = array();
            $clientArray = $client->toArray();
            $clientArray["showURL"] = $this->generateUrl("facture_show", array('id' => $client->getId()));
            $clientArray["editURL"] = $this->generateUrl("facture_edit", array('id' => $client->getId()));
            $clientArray["deleteURL"] = $this->generateUrl("facture_delete", array('id' => $client->getId()));

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
     * @Route("/create", name="facture_create_service")
     * @Method("POST")
     */
    public function createServiceAction(Request $request){



        $em = $this->getDoctrine()->getManager();



        $_facture =  $request->get("facture");

        if(! isset($_facture))return new Response("", 404);

        $facture = new Facture();


        $client = $em->getRepository("AnisCommerceBundle:Client")->findOneById($_facture['client']);

        if($client == null) return new Response("", 404);

        $facture->setClient($client);


        $facture->setDateFacturation(new \DateTime($_facture['dateFacturation']));
        $facture->setDatePaiement(new \DateTime($_facture['datePaiement']));
        $facture->setMethodPaiement($_facture['methodPaiement']);
        $facture->setTotal(intval($_facture['total']));
        $facture->setPaid(intval($_facture['paid']) == 0 ? false : true);



        $em->persist($facture);

        if(isset($_facture['lines']))
        {
            foreach($_facture['lines'] as $_line)
            {
                $line = new \Anis\CommerceBundle\Entity\LigneFacture();

                if(!isset($_line['product']))$_line['product'] = 0;

                $produit = $em->getRepository("AnisCommerceBundle:Produit")->findOneById($_line['product']);


                if($produit != null){
                    $line->setProduct($produit);
                    $line->setFacture($facture);
                    $line->setDiscount( floatval($_line['discount']));
                    $line->setUnityPrice( floatval($_line['unityPrice']));
                    $line->setQuantity( intval($_line['quantity']));

                    //echo var_dump($line->getQuantity());


                    $em->persist($line);

                    $facture->addLine($line);

                }


            }





        }

            //die(var_dump($facture));
        $em->flush();


        return new Response(json_encode($facture->getId()), 200);


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
            $entity->setTotal($entity->getTotal());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('facture'));
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
     * @Route("/{id}/show.{_format}", name="facture_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id, $_format = "html")
    {
        $em = $this->getDoctrine()->getManager();

        $facture = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

        if (!$facture) {
            throw $this->createNotFoundException('Unable to find Facture entity.');
        }





        $html = $this->renderView('AnisCommerceBundle:Facture:show.html.twig',
            array(
                'facture'      => $facture,
            ));

        if($_format == "pdf")
        {


            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'application/pdf'

                ));
        } else if($_format == "jpeg") {



            return new Response(
                $this->get('knp_snappy.image')->getOutputFromHtml($html),
                200,
                array(
                    'Content-Type'          => 'image/jpg'
                )
            );

        }


        return array(
            'facture'      => $facture
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

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
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
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $_facture =  $request->get("facture");

        if(! isset($_facture))return new Response("", 404);

        $facture = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

        if (!$facture) {
            return new Response("", 404);
        }


        $client = $em->getRepository("AnisCommerceBundle:Client")->findOneById($_facture['client']);

        if($client == null) return new Response("", 404);

        $facture->setClient($client);


        $facture->setDateFacturation(new \DateTime($_facture['dateFacturation']));
        $facture->setDatePaiement(new \DateTime($_facture['datePaiement']));
        $facture->setMethodPaiement($_facture['methodPaiement']);
        $facture->setTotal(intval($_facture['total']));
        $facture->setPaid(intval($_facture['paid']) == 0 ? false : true);




        foreach($facture->getLines() as $l)
        {
            $em->remove($l);
        }

        $facture->emptyLines();


        if(isset($_facture['lines']))
        {
            foreach($_facture['lines'] as $_line)
            {
                $line = new \Anis\CommerceBundle\Entity\LigneFacture();

                if(!isset($_line['product']))$_line['product'] = 0;

                $produit = $em->getRepository("AnisCommerceBundle:Produit")->findOneById($_line['product']);


                if($produit != null){
                    $line->setProduct($produit);
                    $line->setFacture($facture);
                    $line->setDiscount( floatval($_line['discount']));
                    $line->setUnityPrice( floatval($_line['unityPrice']));
                    $line->setQuantity( intval($_line['quantity']));

                    //echo var_dump($line->getQuantity());


                    $em->persist($line);

                    $facture->addLine($line);

                }


            }





        }

        //die(json_encode(array("id" => $facture->getId(), "total" => $facture->getTotal())));



        $em->flush($facture);
        $em->flush();


        return new Response(json_encode($facture->getId()), 200);
        /*return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );*/
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

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnisCommerceBundle:Facture')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Facture entity.');
            }

            $em->remove($entity);
            $em->flush();

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
