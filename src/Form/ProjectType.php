<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ProjectStep;
use App\Form\ProjectStepType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',
                'format' => 'DD/MM/YYYY',
                'html5' => false,
                'data' => new \DateTime(),
                'attr' => [
                    'class' => 'datepicker-full'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'editable',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
