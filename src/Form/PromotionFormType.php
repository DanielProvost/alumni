<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\Promotion;
use App\Entity\Year;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degree',EntityType::class,['class' => Degree::class,
                'choice_label' => 'name',
                'label' =>'Formation associée'])
            ->add('year',EntityType::class,['class'=>Year::class,
                'choice_label' => 'title',
                'label' => 'Année associée'])
            ->add('startDate', DateType::class, [
                'label' =>'Date de début',
                'required' => false
                ])
            ->add('endDate', DateType::class, [
                'label' =>'Date de fin',
                'required' => false
            ])
            ->add('notes', TextareaType::class, [
                'label' =>'Notes',
                'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
