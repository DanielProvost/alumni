<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class AlumniController extends AbstractController{
    /**
     * @Route("/alumni/{id}/{slug}", name="alumni.index")
     */

    public function index(User $user,$slug){


//        dd($user,$slug);

        return $this->render('alumni.html.twig',['user'=>$user]);
    }

}