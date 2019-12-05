<?php

namespace App\Controller;

use App\Entity\Degree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DegreeController extends AbstractController{

    /**
     * @Route("/formation/{id}", name="formation.id")
     */

    public function index(Degree $degree )
    {
        return $this->render('formations/index.html.twig', ['formations' => $degree]);
    }

}