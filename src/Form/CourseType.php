<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\User;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('status', ChoiceType::class, [
                    'choices'  => [
                        'Pending' => 'PENDING',
                        'Active' => 'ACTIVE',
                    ],
            ])
            ->add('teacher', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
            ])
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
