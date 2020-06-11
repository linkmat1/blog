<?php

namespace App\Controller;



use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController {

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

    /**
     * @Route("/{slug}{id}", name="blog_show", methods={"GET"})
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Post $post){

        return $this->render('blog/show.html.twig', compact('post'));
    }
}