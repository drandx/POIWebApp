<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

use Interactive\POIWebAppBundle\Entity\Route;
use Interactive\POIWebAppBundle\Form\RouteType;


/**
 * Route controller.
 *
 */
class RouteController extends Controller
{

    /**
     * 
     * @param type $GET
     * 
     */
    public function getRoutePointsAction($id) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $em = $this->getDoctrine()->getManager();
        $points = $em->getRepository('POIWebAppBundle:RoutePoint')->findBy(array('route' => $id));

        if (count($points) > 0) {
            $routesReturn = array('points' => $points);
            $json =  json_encode($routesReturn);
            $response->setContent($json);
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode(404);
        }
        return $response;
    }
    
    /**
     * Lists all Route entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('POIWebAppBundle:Route')->findAll();

        return $this->render('POIWebAppBundle:Route:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Route entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Route();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_route_show', array('id' => $entity->getId())));
        }

        return $this->render('POIWebAppBundle:Route:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Route entity.
     *
     * @param Route $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Route $entity)
    {
        $form = $this->createForm(new RouteType(), $entity, array(
            'action' => $this->generateUrl('poi_route_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Route entity.
     *
     */
    public function newAction()
    {
        $entity = new Route();
        $form   = $this->createCreateForm($entity);

        return $this->render('POIWebAppBundle:Route:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Route entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:Route')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Route entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:Route:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Route entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:Route')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Route entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:Route:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Route entity.
    *
    * @param Route $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Route $entity)
    {
        $form = $this->createForm(new RouteType(), $entity, array(
            'action' => $this->generateUrl('poi_route_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Route entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:Route')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Route entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_route_edit', array('id' => $id)));
        }

        return $this->render('POIWebAppBundle:Route:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Route entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('POIWebAppBundle:Route')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Route entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poi_route'));
    }

    /**
     * Creates a form to delete a Route entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_route_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
