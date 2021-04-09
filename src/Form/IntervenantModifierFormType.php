<?php

namespace App\Form;
use App\Entity\Users;
use App\Entity\Intervenants;
use App\Entity\InterWithMatiere;
use App\Entity\Matieres;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntervenantModifierFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class,[
            'label' => 'Nom',
            'data' => $options['intervenant']->getNom(),
            'empty_data' => $options['intervenant']->getNom(),
        ])
        ->add('prenom', TextType::class,[
            'label' => 'Prénom',
            'data' => $options['intervenant']->getPrenom(),
            'empty_data' => $options['intervenant']->getPrenom(),
        ])
        ->add('email', EmailType::class,[
            'label' => 'Mail',
            'data' => $options['intervenant']->getEmail(),
            'empty_data' => $options['intervenant']->getEmail(),
        ])
        ->add('password', PasswordType::class,[
            'label' => 'Mot de passe',
            'data' => $options['intervenant']->getPassword(),
            'empty_data' => $options['intervenant']->getPassword(),
        ])
        ->add('idmatiere', EntityType::class, 
        array(
         'class' => Matieres::class,
         'choice_label' => 'nom',
         'expanded' => true,
         'multiple' => true,
        )
 )
        ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'intervenant' => User::class,
        ]);
    }
}
