<?php

namespace App\Controller;



use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @var PostRepository
     */
    private PostRepository $pr;

    public function __construct(PostRepository $pr)
    {

        $this->pr = $pr;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index() {

        $posts = $this->pr->findAll();

       return $this->render('page/index.html.twig', compact('posts'));
    }

}