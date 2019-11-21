<?php

namespace App\Controller\Admin;

use App\Repository\DegreeRepository;
use App\Repository\PromotionRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

    /**
     * @Route("/admin",name = "admin.index")
     */

    public function index(DegreeRepository $degreeRepository,YearRepository $yearRepository,PromotionRepository $promotionRepository)
    {
        $templateData = [];
        $templateData['degrees']=$degreeRepository->findBy([],['name' => 'ASC']);
        $templateData['years']=$yearRepository->findBy([],['title' => 'ASC']);
        $templateData['promotions']=$promotionRepository->getAllOrderByDegreeAndYear();

        return $this->render('admin/index.html.twig',$templateData);
    }

}