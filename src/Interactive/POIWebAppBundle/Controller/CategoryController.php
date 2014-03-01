<?php

namespace Interactive\POIWebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Interactive\POIWebAppBundle\Entity\Category;

/**
 * Description of CategoryController
 *
 * @author drandx
 */
class CategoryController extends Controller{
    
    public function showAction($slug,$page)
    {
        $em = $this->getDoctrine()->getManager();
 
    $category = $em->getRepository('POIWebAppBundle:Category')->findOneBySlug($slug);
 
    if (!$category) {
        throw $this->createNotFoundException('Unable to find Category entity.');
    }
 
    $total_jobs = $em->getRepository('POIWebAppBundle:Job')->countActiveJobs($category->getId());
    
    $jobs_per_page = $this->container->getParameter('max_jobs_on_category');
    $last_page = ceil($total_jobs / $jobs_per_page);
    $previous_page = $page > 1 ? $page - 1 : 1;
    $next_page = $page < $last_page ? $page + 1 : $last_page;
    $category->setActiveJobs($em->getRepository('POIWebAppBundle:Job')->getActiveJobs($category->getId(), $jobs_per_page, ($page - 1) * $jobs_per_page));
 
    return $this->render('POIWebAppBundle:Category:show.html.twig', array(
        'category' => $category,
        'last_page' => $last_page,
        'previous_page' => $previous_page,
        'current_page' => $page,
        'next_page' => $next_page,
        'total_jobs' => $total_jobs
    ));
    }
    
}