<?php

namespace App\Form;

use App\Entity\Promotion;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', TextType::class)
            ->add('speciality', TextType::class)
            ->add('code', TextType::class)
            ->add('startedAt', DateType::class, [
                'widget' => 'single_text',
                'format' => 'MM/yyyy',
                'html5' => false,
                'attr' => [
                    'class' => 'full-datepicker'
                ]
            ])
            ->add('finishedAt', DateType::class, [
                'widget' => 'single_text',
                'format' => 'MM/yyyy',
                'html5' => false,
                'attr' => [
                    'class' => 'full-datepicker'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
