<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ArticleRepository;
use AppBundle\Entity\UserRepository;
use AppBundle\Entity\TagRepository;
use AppBundle\Entity\CategoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiController
 *
 * @package AppBundle\Controller
 *
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/article/{id}", name="api_article", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function articleAction()
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        // Retrieve Entity Repository
        /** @var ArticleRepository $repo */
        $repo = $em->getRepository('AppBundle:Article');

        // Retrieve all Article entities
        $articles = $repo->findCatchAll();
        return new JsonResponse($articles);
    }

    /**
     * @Route("/user/{id}", name="api_user", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function userAction()
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        /** @var UserRepository $repo */
        $repo = $em->getRepository('AppBundle:User');

        // Retrieve all Pokemon entities
        $users = $repo->findCatchAll();

        return new JsonResponse($users);
    }


    /**
     * @Route("/category/{id}", name="api_category", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function categoryAction()
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        /** @var CategoryRepository $repo */
        $repo = $em->getRepository('AppBundle:Category');

        // Retrieve all Pokemon entities
        $categories = $repo->findCatchAll();
        return new JsonResponse($categories);
    }

    /**
     * @Route("/tag/{id}", name="api_tag", defaults={"id" = null}, requirements={"id" = "\d+"})
     */
    public function tagAction()
    {
        // Retrieve Doctrine Manager
        $em = $this->getDoctrine()->getManager();

        /** @var TagRepository $repo */
        $repo = $em->getRepository('AppBundle:Tag');

        // Retrieve all Pokemon entities
        $tags = $repo->findCatchAll();
        return new JsonResponse($tags);
    }
}