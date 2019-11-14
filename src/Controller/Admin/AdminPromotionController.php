<?php

namespace App\Controller\Admin;


use App\Entity\Promotion;
use App\Form\PromotionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPromotionController extends AbstractController{
    /**
     * @Route ("/admin/promotion/new",name="admin.promotion.new")
     */

    public function new(Request $request){

        $form = $this->createForm(PromotionFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $promotion = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();
            $this->addFlash('success', 'La nouvelle promotion est crée!');
            return $this->redirectToRoute('admin.index');
        }

        return $this->render('admin/promotion/new.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/promotion/{id}/edit", name ="admin.promotion.edit")
     */

    public function edit(Request $request, Promotion $promotion){
        $form = $this->createForm(PromotionFormType::class, $promotion);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('sucess','Promotion mise à jour avec succès');
            return $this->redirectToRoute('admin.index');

        }
        return $this->render('admin/promotion/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/promotion/{id}/delete", name ="admin.promotion.delete")
     */
    public function delete(Promotion $promotion)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($promotion);
        $manager->flush();

        $this->addFlash('success','Promotion supprimée avec succès!');

        return $this->redirectToRoute('admin.index');
    }
}