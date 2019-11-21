<?php

namespace App\Controller\Admin;

use App\Entity\Year;
use App\Form\YearFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminYearController extends AbstractController{

    /**
     * @Route ("/admin/year/new",name="admin.year.new")
     */


    public function new(Request $request){

        $form = $this->createForm(YearFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $degree = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($degree);
            $em->flush();
            $this->addFlash('success', 'L\'année a été ajoutée!');
            return $this->redirectToRoute('admin.index',['_fragment' => 'annees']);
        }

        return $this->render('admin/year/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/year/{id}/edit", name ="admin.year.edit")
     */

    public function edit(Request $request,Year $year){
        $form = $this->createForm(YearFormType::class, $year);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('sucess','Année mise à jour avec succès');
            return $this->redirectToRoute('admin.index',['_fragment' => 'annees']);

        }
        return $this->render('admin/year/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/year/{id}/delete", name ="admin.year.delete")
     */
    public function delete(Year $year)
    {
        $id = 'year-'. $year->getId();
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($year);
        $manager->flush();

        return $this->json($id);
    }

}