<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserRegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
        
            ->add('email', EmailType::class, [
                'label' => 'Email :'
            ])
            
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo :'
            ])
            ;
 
        if (in_array('registration', $options['validation_groups'])) {
            $builder
                ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options'  => array('label' => 'Mot de passe :'),
                    'second_options' => array('label' => 'Confirmer le mot de passe :'),
                ))
                ;
        } else {
            $builder
                ->add('plainPassword', RepeatedType::class, array(
                    'required' => false,
                    'type' => PasswordType::class,
                    'first_options'  => array('label' => 'Mot de passe :'),
                    'second_options' => array('label' => 'Confirmer le mot de passe :'),
                ))
                ;
        }
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Users::class,
        ));
    }
}