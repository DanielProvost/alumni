<?php
namespace App\Controller;



use App\Entity\Degree;
use App\Entity\Year;
use App\Repository\DegreeRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**

     * @Route("/",name="home.index")
     */
    public function index(DegreeRepository $degreeRepo, YearRepository $yearRepo){
        $degrees= $degreeRepo->findAll();

        $years = $yearRepo->findAll();

        return $this->render('home.html.twig',['degrees' =>$degrees,
                                            'sessions' =>$years]);

    }
}
