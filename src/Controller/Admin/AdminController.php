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
        $templateData['degrees']=$degreeRepository->findAll();
        $templateData['years']=$yearRepository->findAll();
        $templateData['promotions']=$promotionRepository->findAll();

        return $this->render('admin/index.html.twig',$templateData);
    }
}