<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\User;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\UserRepository;

class CourseClassroomType extends AbstractType
{
    public function __construct(UserRepository $userRepository)
    {
        $this->ur = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $teachers = $this->ur->findByRole('ROLE_TEACHER');

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
            'choice_label' => 'username',
            'choices' => $teachers
        ])
        ->add('description', TextareaType::class, [
            'label' => false,
            'attr' => [
                'class' => 'editable',
            ]
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
