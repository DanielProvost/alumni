<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Form\PromotionFormType;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    /**
     * @Route("/promotions", name="promotions")
     */
    public function index(PromotionRepository $promotionRepository)
    {
        $templateData['promotions']=$promotionRepository->getAllOrderByDegreeAndYear();

        return $this->render('promotion/index.html.twig', $templateData);
    }


    /**
     * @Route("/promotion/{id}", name="promotions.id")
     */

    public function show(Promotion $promotion)
    {

        return $this->render('promotion/detail.html.twig', ['promotions' => $promotion]);
    }
}
