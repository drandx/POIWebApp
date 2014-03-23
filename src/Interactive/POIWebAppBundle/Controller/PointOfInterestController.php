<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interactive\POIWebAppBundle\Entity\PointOfInterest;
use Interactive\POIWebAppBundle\Form\PointOfInterestType;

/**
 * PointOfInterest controller.
 *
 */
class PointOfInterestController extends Controller
{

    /**
     * Lists all PointOfInterest entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('POIWebAppBundle:PointOfInterest')->findAll();

        return $this->render('POIWebAppBundle:PointOfInterest:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PointOfInterest entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PointOfInterest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_point_show', array('id' => $entity->getId())));
        }

        return $this->render('POIWebAppBundle:PointOfInterest:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a PointOfInterest entity.
    *
    * @param PointOfInterest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(PointOfInterest $entity)
    {
        $form = $this->createForm(new PointOfInterestType(), $entity, array(
            'action' => $this->generateUrl('poi_point_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PointOfInterest entity.
     *
     */
    public function newAction()
    {
        $entity = new PointOfInterest();
        $form   = $this->createCreateForm($entity);

        return $this->render('POIWebAppBundle:PointOfInterest:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PointOfInterest entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:PointOfInterest:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing PointOfInterest entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:PointOfInterest:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PointOfInterest entity.
    *
    * @param PointOfInterest $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PointOfInterest $entity)
    {
        $form = $this->createForm(new PointOfInterestType(), $entity, array(
            'action' => $this->generateUrl('poi_point_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PointOfInterest entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_point_edit', array('id' => $id)));
        }

        return $this->render('POIWebAppBundle:PointOfInterest:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PointOfInterest entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poi_point'));
    }

    /**
     * Creates a form to delete a PointOfInterest entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_point_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}