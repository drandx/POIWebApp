<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Interactive\POIWebAppBundle\Entity\PointOfInterest;
use Interactive\POIWebAppBundle\Form\PointOfInterestType;
use Interactive\POIWebAppBundle\Model\UploadFileMover;

/**
 * PointOfInterest controller.
 *
 */
class PointOfInterestController extends Controller {

    /**
     * Loads the front end with a mapt
     * 
     */
    public function frontIndexAction() {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('POIWebAppBundle:Category')->
                findBy(array(), array('name' => 'ASC')
        );
        
        $routes = $em->getRepository('POIWebAppBundle:Route')->
                findBy(array(), array('name' => 'ASC')
        );
        
        return $this->render('POIWebAppBundle:PointOfInterest:front.html.twig', array('categories' => $categories,'routes'=>$routes));
    }

    public function getPointsbyCityAction($cityid) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('POIWebAppBundle:PointOfInterest')->findBy(array('geocity' => $cityid));

        if (count($entities) > 0) {
            $pointsReturn = array('pois' => $entities);
            $response->setContent(json_encode($pointsReturn));
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode(404);
        }
        return $response;
    }

    /**
     * 
     * @param type $query
     * 
     */
    public function getPointsbyQueryAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        //Query to analyze
        $requestContent = $request->getContent();
        $requestArray = json_decode($requestContent, true);
        
        $cityQyery = $requestArray['cityQuery'];
        $categoriesQuery = $requestArray['categories'];
        $route = $requestArray['route'];
        $queryBreakDown = explode(",", $cityQyery)[0];
        $stateName = "";
        $cityName = "";
        
        //If he strin is created in this way: City - State, Country
        if(strpos($queryBreakDown, ' - ')!= FALSE){
            $cityName = rtrim(ltrim(explode("-", $queryBreakDown)[0]));
            $stateName = rtrim(ltrim(explode("-", $queryBreakDown)[1]));
            
        }
        else{
            $cityName = $queryBreakDown;
            $stateName = "";
        }
        
        $result_points = $em->getRepository('POIWebAppBundle:PointOfInterest')->PointsOfInterestJoinCityState($cityName,$stateName,$categoriesQuery,$route);
        
        
        //$result_points = $em->getRepository('POIWebAppBundle:PointOfInterest')->findAll();
        

        if (true) {
            $response->setStatusCode(200);
            $response->setContent(json_encode($result_points));
        } else {
            $response->setStatusCode(404);
        }
        return $response;
    }

    /**
     * Renders a Map
     * 41.962457, -87.675596
     */
    public function renderMapAction() {
        //TODO - Get the points to fender on the map
        // $em = $this->getDoctrine()->getManager();
        //$entities = $em->getRepository('POIWebAppBundle:PointOfInterest')->findAll();

        return $this->render('POIWebAppBundle:PointOfInterest:map.html.twig', array(
                    'latitude' => '41.962457', 'longitude' => '-87.675596'
        ));
    }
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $page
     * @return type
     */
    public function resultsAction(Request $request, $page) {
        $session = $this->getRequest()->getSession();
        $query = $request->request->get('query');
        if($query){
            //Stores query in session
            $session->set('currentQuery',$query);
        }
        else{
            //Gets query from session
            $query = $session->get('currentQuery');
        }
        $em = $this->getDoctrine()->getManager();
        
        $pois_per_page = $this->container->getParameter('max_points_on_pointslist');
        
        $entities = $em->getRepository('POIWebAppBundle:PointOfInterest')->getPointsOfInterestbyQuery($query, $pois_per_page, ($page - 1) * $pois_per_page);
        
        
        $previous_page = $page > 1 ? $page - 1 : 1;
        $total_pois = $em->getRepository('POIWebAppBundle:PointOfInterest')->countPointsOfInterestbyQuery($query);
        $last_page = ceil($total_pois / $pois_per_page);
        $next_page = $page < $last_page ? $page + 1 : $last_page;

        return $this->render('POIWebAppBundle:PointOfInterest:pois_results.html.twig', array(
                    'entities' => $entities,
                    'last_page' => $last_page,
                    'previous_page' => $previous_page,
                    'current_page' => $page,
                    'next_page' => $next_page,
                    'total_items' => $total_pois
        ));
    }

    /**
     * Lists all PointOfInterest entities.
     *
     */
    public function indexAction($page) {
        $em = $this->getDoctrine()->getManager();

        $total_pois = $em->getRepository('POIWebAppBundle:PointOfInterest')->countPointsOfInterest();
        $pois_per_page = $this->container->getParameter('max_points_on_pointslist');
        $last_page = ceil($total_pois / $pois_per_page);
        $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;

        $entities = $em->getRepository('POIWebAppBundle:PointOfInterest')->getPointsOfInterest($pois_per_page, ($page - 1) * $pois_per_page);

        return $this->render('POIWebAppBundle:PointOfInterest:index.html.twig', array(
                    'entities' => $entities,
                    'last_page' => $last_page,
                    'previous_page' => $previous_page,
                    'current_page' => $page,
                    'next_page' => $next_page,
                    'total_items' => $total_pois
        ));
    }

    /**
     * Creates a new PointOfInterest entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new PointOfInterest();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        $imgFile = $form["img"]->getData();
        $uploadFileMover = new UploadFileMover();
        
        $res = $uploadFileMover->processImageFile($imgFile);
        
        if(!$res['status']){
            $form->get('img')->addError(new FormError($res['content']));
        }
        else{
            $img_path = $this->getRequest()->getBasePath() . DIRECTORY_SEPARATOR . $res['content'];
            $entity->setImgPath($img_path);
        }

        if ($form->isValid() && ($res['status'] == true)) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('poi_point_edit', array('id' => $entity->getId())));
        }

        return $this->render('POIWebAppBundle:PointOfInterest:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PointOfInterest entity.
     *
     * @param PointOfInterest $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PointOfInterest $entity) {
        $form = $this->createForm(new PointOfInterestType(), $entity, array(
            'action' => $this->generateUrl('poi_point_create'),
            'method' => 'POST',
        ));
        return $form;
    }

    /**
     * Displays a form to create a new PointOfInterest entity.
     *
     */
    public function newAction() {
        $entity = new PointOfInterest();
        $form = $this->createCreateForm($entity);

        return $this->render('POIWebAppBundle:PointOfInterest:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PointOfInterest entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:PointOfInterest:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing PointOfInterest entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('POIWebAppBundle:PointOfInterest:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
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
    private function createEditForm(PointOfInterest $entity) {
        $form = $this->createForm(new PointOfInterestType(), $entity, array(
            'action' => $this->generateUrl('poi_point_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }

    /**
     * Edits an existing PointOfInterest entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        
        
        $entity = $em->getRepository('POIWebAppBundle:PointOfInterest')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PointOfInterest entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        //Image handling
        $imgFile = $editForm["img"]->getData();
        $uploadFileMover = new UploadFileMover();
        
        $res = $uploadFileMover->processImageFile($imgFile);
        
        if(!$res['status']){
            //$editForm->get('img')->addError(new FormError($res['content']));
        }
        else{
            $img_path = $this->getRequest()->getBasePath() . DIRECTORY_SEPARATOR . $res['content'];
            $entity->setImgPath($img_path);
        }
        //End image handling
        
        
        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('poi_point_edit', array('id' => $id)));
        }

        return $this->render('POIWebAppBundle:PointOfInterest:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PointOfInterest entity.
     *
     */
    public function deleteAction(Request $request, $id) {
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
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('poi_point_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
