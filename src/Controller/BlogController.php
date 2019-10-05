<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    private const POST= [
        ['id'=>1, 'slug'=>'uno', 'title'=>'titulo 1'],
        ['id'=>2, 'slug'=>'dos', 'title'=>'titulo 2'],
        ['id'=>3, 'slug'=>'tres', 'title'=>'titulo 3'],
    ];

    /**
     * @Route("/{page}", name="blog_list", defaults={"page"=3})
     */
    public function list($page=1){
        return new JsonResponse(
            [
                'page'=>$page,
                self::POST
            ]);
    }

    /**
     * @Route("/{id}", name="blog_by_id", requirements={"id"="\d+"})
     */
    public function find_by_id($id){
        return new JsonResponse(self::POST[array_search($id, array_column(self::POST, 'id'))]);
    }

    /**
     * @Route("/slug/{slug}", name="blog_by_slug")
     */
    public function find_by_slug($slug){
        return new JsonResponse(self::POST[array_search($slug, array_column(self::POST, 'slug'))]);
    }
}