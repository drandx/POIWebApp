<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interactive\POIWebAppBundle\Entity\GeoCity;
use Interactive\POIWebAppBundle\Form\GeoCityType;

/**
 * GeoCity controller.
 *
 */
class GeoCityController extends Controller
{

    /**
     * Lists all GeoCity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('POIWebAppBundle:GeoCity')->findAll();

        return $this->render('POIWebAppBundle:GeoCity:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new GeoCity entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new GeoCity();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_geocity_show', array('id' => $entity->getId())));
        }

        return $this->render('POIWebAppBundle:GeoCity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a GeoCity entity.
    *
    * @param GeoCity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GeoCity $entity)
    {
        $form = $this->createForm(new GeoCityType(), $entity, array(
            'action' => $this->generateUrl('poi_geocity_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GeoCity entity.
     *
     */
    public function newAction()
    {
        $entity = new GeoCity();
        $form   = $this->createCreateForm($entity);

        return $this->render('POIWebAppBundle:GeoCity:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GeoCity entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:GeoCity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoCity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:GeoCity:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing GeoCity entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:GeoCity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoCity entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:GeoCity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a GeoCity entity.
    *
    * @param GeoCity $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GeoCity $entity)
    {
        $form = $this->createForm(new GeoCityType(), $entity, array(
            'action' => $this->generateUrl('poi_geocity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GeoCity entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:GeoCity')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoCity entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_geocity_edit', array('id' => $id)));
        }

        return $this->render('POIWebAppBundle:GeoCity:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a GeoCity entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('POIWebAppBundle:GeoCity')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GeoCity entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poi_geocity'));
    }

    /**
     * Creates a form to delete a GeoCity entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_geocity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
