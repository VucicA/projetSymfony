<?php

namespace App\Form;

use App\Entity\Intervenants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntervenantAjouterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nomIntervenant', TextType::class,[
            'label' => 'Nom'
        ])
        ->add('prenomIntervenant', TextType::class,[
            'label' => 'Prénom'
        ])
        ->add('mailIntervenant', EmailType::class,[
            'label' => 'Mail'
        ])
        ->add('password', PasswordType::class,[
            'label' => 'Mot de passe'
        ])
        ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Intervenants::class,
        ]);
    }
}