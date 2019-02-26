<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\FileType;
use App\Entity\File;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('number', TextType::class)
            ->add('streetName', TextType::class)
            ->add('postalCode', TextType::class)
            ->add('avatar', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('city', TextType::class)
            ->add('avatar', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['edit'],
        ]);
    }
}
