<?php

namespace App\Controller;

use App\Repository\DegreeRepository;
use App\Repository\UserRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/",name="home.index")
     */

    public function index(UserRepository $userRepository, DegreeRepository $degreeRepo, YearRepository $yearRepo, Request $request)
    {
        $users = null;
        if ($request->request->count()) {
            $degree = $request->get('degree');
            $year = $request->get('year');
            $users = $userRepository->search($degree, $year);
//            dd($users);
        }


        $degrees = $degreeRepo->findAll();
        $years = $yearRepo->findAll();
        return $this->render('home.html.twig', ['degrees' => $degrees,
            'sessions' => $years,
            'users' => $users
        ]);


    }


}
