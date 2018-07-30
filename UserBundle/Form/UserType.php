<?php

namespace UserBundle\Form;

use UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                 'attr' => array(
                     'class' => 'form-control',
                     'placeholder' => 'Email',
                )))
            ->add('username', TextType::class, array(
                'label' => 'Usuario',
                 'attr' => array(
                     'class' => 'form-control',
                     'placeholder' => 'Usuario',
                )))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => 'Password',
                     'attr' => array(
                         'class' => 'form-control',
                         'placeholder' => 'Contraseña',
                    )),
                'second_options' => array(
                    'label' => 'Repeat Password',
                     'attr' => array(
                         'class' => 'form-control',
                         'placeholder' => 'Repetir contraseña',
                    )),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}