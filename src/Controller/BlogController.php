<?php


namespace App\Controller;


use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/{page}", name="blog_list", defaults={"page"=3}, requirements={"page"="\d+"})
     */
    public function list($page=1, Request $request){
        $limit= $request->get("limit");
//        return new JsonResponse($limit);
        return new JsonResponse(
            [
                'page'=>$page,
                'limit'=>$limit,
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

    /**
     * @Route("/add", name="blog_add", methods={"POST"})
     */
    public function add(Request $request){
        $serializer= $this->get('serializer');
        $blogPost= $serializer->deserialize($request->getContent(), BlogPost::class, 'json');

        $em=$this->getDoctrine()->getManager();
        $em->persist($blogPost);
        $em->flush();

        return $this->json($blogPost);
    }
}