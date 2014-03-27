<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Interactive\POIWebAppBundle\Entity\GeoCountry;
use Interactive\POIWebAppBundle\Form\GeoCountryType;

/**
 * GeoCountry controller.
 *
 */
class GeoCountryController extends Controller
{

    /**
     * Lists all GeoCountry entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('POIWebAppBundle:GeoCountry')->findAll();

        return $this->render('POIWebAppBundle:GeoCountry:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new GeoCountry entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new GeoCountry();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_geocountry_show', array('id' => $entity->getId())));
        }

        return $this->render('POIWebAppBundle:GeoCountry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a GeoCountry entity.
    *
    * @param GeoCountry $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GeoCountry $entity)
    {
        $form = $this->createForm(new GeoCountryType(), $entity, array(
            'action' => $this->generateUrl('poi_geocountry_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GeoCountry entity.
     *
     */
    public function newAction()
    {
        $entity = new GeoCountry();
        $form   = $this->createCreateForm($entity);

        return $this->render('POIWebAppBundle:GeoCountry:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GeoCountry entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:GeoCountry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoCountry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:GeoCountry:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing GeoCountry entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:GeoCountry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoCountry entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:GeoCountry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a GeoCountry entity.
    *
    * @param GeoCountry $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GeoCountry $entity)
    {
        $form = $this->createForm(new GeoCountryType(), $entity, array(
            'action' => $this->generateUrl('poi_geocountry_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GeoCountry entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:GeoCountry')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GeoCountry entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_geocountry_edit', array('id' => $id)));
        }

        return $this->render('POIWebAppBundle:GeoCountry:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a GeoCountry entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('POIWebAppBundle:GeoCountry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GeoCountry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('poi_geocountry'));
    }

    /**
     * Creates a form to delete a GeoCountry entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('poi_geocountry_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
