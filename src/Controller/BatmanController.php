<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/batman", requirements={"locale": "en|es|fr"}, name="batman_")
 */
class BatmanController extends AbstractController
{
    /**
     * @Route("/home/{_locale}", name="index")
     */
    public function index()
    {
        return $this->render("batman/index.html.twig");
    }

    /**
     * @Route("/list", name="list")
     */
    public function list(Request $request)
    {
        $routeName = $request->attributes->get('_route');
        $routeParameters = $request->attributes->get('_route_params');

        // use this to get all the available attributes (not only routing ones):
        $allAttributes = $request->attributes->all();

        return $this->render("batman/list.html.twig", ['routeName'=>$routeName]);
    }

}
