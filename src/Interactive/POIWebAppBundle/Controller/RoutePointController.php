<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interactive\POIWebAppBundle\Entity\RoutePoint;
use Interactive\POIWebAppBundle\Form\RoutePointType;

/**
 * RoutePoint controller.
 *
 */
class RoutePointController extends Controller
{

    /**
     * Lists all RoutePoint entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('POIWebAppBundle:RoutePoint')->findAll();

        return $this->render('POIWebAppBundle:RoutePoint:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new RoutePoint entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new RoutePoint();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_route_point_show', array('id' => $entity->getId())));
        }

        return $this->render('POIWebAppBundle:RoutePoint:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a RoutePoint entity.
     *
     * @param RoutePoint $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RoutePoint $entity)
    {
        $form = $this->createForm(new RoutePointType(), $entity, array(
            'action' => $this->generateUrl('poi_route_point_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RoutePoint entity.
     *
     */
    public function newAction()
    {
        $entity = new RoutePoint();
        $form   = $this->createCreateForm($entity);

        return $this->render('POIWebAppBundle:RoutePoint:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RoutePoint entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:RoutePoint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RoutePoint entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:RoutePoint:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RoutePoint entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:RoutePoint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RoutePoint entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:RoutePoint:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a RoutePoint entity.
    *
    * @param RoutePoint $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RoutePoint $entity)
    {
        $form = $this->createForm(new RoutePointType(), $entity, array(
            'action' => $this->generateUrl('poi_route_point_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RoutePoint entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:RoutePoint')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RoutePoint entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_route_point_edit', array('id' => $id)));
        }

        return $this->render('POIWebAppBundle:RoutePoint:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a RoutePoint entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('POIWebAppBundle:RoutePoint')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RoutePoint entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poi_route_point'));
    }

    /**
     * Creates a form to delete a RoutePoint entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_route_point_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
