<?php

namespace App\Form;

use App\Entity\Matieres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class  MatiereModifierFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class,[
            'label' => 'Libelle'
        ])
        ->add('NbHeure', TextType::class,[
            'label' => 'Nombre d\'heure'
        ])
        ->add('textcolor', ColorType::class,[
            'label' => 'Couleur du texte'
        ])
        ->add('backgroundcolor', ColorType::class,[
            'label' => 'Couleur de fond'
        ])
        ->add('bordercolor', ColorType::class,[
            'label' => 'Couleur du contour'
        ])
        ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matieres::class,
        ]);
    }
}
