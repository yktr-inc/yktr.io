<?php

namespace App\Form;

use App\Entity\ProjectStep;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectStepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('stepOrder', NumberType::class)
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('endAt', DateTimeType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy H:i',
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
            'data_class' => ProjectStep::class,
        ]);
    }
}
