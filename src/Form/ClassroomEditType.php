<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Promotion;
use App\Entity\Projects;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ClassroomEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('promotion', EntityType::class, [
                'class' => Promotion::class,
                'choice_label' => 'code',
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'placeholder' => 'Choose an option',
                'choice_label' => 'fullname',
                'required' => false,
                'multiple' => true,
                'by_reference' => false,
                'attr' => [
                    'class' => 'select-popup'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
