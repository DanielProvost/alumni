<?php

namespace App\Controller\Admin;

use App\Entity\Degree;
use App\Form\DegreeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminDegreeController extends AbstractController{

    /**
     * @Route ("/admin/degree/new",name="admin.degree.new")
     */

    public function new(Request $request){

        $form = $this->createForm(DegreeFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $degree = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($degree);
            $em->flush();
            $this->addFlash('success', 'La nouvelle formation est crée!');
            return $this->redirectToRoute('admin.index',['_fragment' => 'formations']);
        }

        return $this->render('admin/degree/new.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/degree/{id}/edit", name ="admin.degree.edit")
     */

    public function edit(Request $request, Degree $degree){
        $form = $this->createForm(DegreeFormType::class, $degree);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('sucess','Formation mise à jour avec succès');
            return $this->redirectToRoute('admin.index',['_fragment' => 'formations']);

        }
        return $this->render('admin/degree/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/degree/{id}/delete", name ="admin.degree.delete")
     */
    public function delete(Degree $degree)
    {
        $id = 'degree-'.$degree->getId();
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($degree);
        $manager->flush();

       return $this->json($id);
    }
}