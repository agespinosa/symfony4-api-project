<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LuckyController extends AbstractController
{
    /**
      * @Route("/lucky/number", name="lucky_number", methods={"GET", "HEAD"})
     */
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig',["number" => $number]);
    }

    /**
     * @Route("/lucky/show/{parametro}" , name="lucky_show", methods={"GET"},  requirements={"parametro"="\d+"})
     */
    public function show(int $parametro){
        return $this->render("/lucky/show.html.twig", ["parametro"=>$parametro]);
    }

    /**
     * @Route("/lucky/list/{numero}" , name="lucky_list", requirements={"numero"="\d+"}
     *     )
     */
    public function list(int $numero=1){
        return $this->render("/lucky/list.html.twig", ["numero"=>$numero]);
    }
}