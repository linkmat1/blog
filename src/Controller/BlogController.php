<?php

namespace App\Controller;



use App\Entity\CategoryBlog;
use App\Entity\Post;
use App\Repository\CategoryBlogRepository;
use App\Repository\PostRepository;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use Symfony\Bridge\PhpUnit\Legacy\PolyfillTestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController {



    /**
     * @var PostRepository
     */
    private PostRepository $pr;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $e;


    /**
     * BlogController constructor.
     * @param PostRepository $pr
     * @param EntityManagerInterface $e
     */
    public function __construct(PostRepository $pr, EntityManagerInterface $e)
    {

        $this->pr = $pr;

        $this->e = $e;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response {

        $posts = $this->pr->findAll();

       return $this->render('page/index.html.twig', compact('posts'));
    }


    /**
     * @Route("/blog/{slug<[a-z0-9\-]+>}-{id<\d+>}", name="blog_show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        return $this->render('blog/show.html.twig', [
            'post' => $post,
            'menu' => 'blog'
        ]);
    }

    /**
     * @Route("/blog/category/{id<\d+>}", name="blogCat_show")

     * @return Response
     */
    public function showCategory(CategoryBlogRepository $c): Response {


        $cat = $c->findAll();

        return $this->render('blog/category.html.twig', compact( 'cat'));
    }

}