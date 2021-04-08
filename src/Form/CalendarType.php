<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Matieres;
use App\Entity\Intervenants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        
        $builder
            ->add('title')
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('description')
            ->add('all_day')
            ->add('ferie')
            ->add('idmatiere', EntityType::class, 
                   array(
                    'class' => Matieres::class,
                    'choice_label' => 'nom',
                    'expanded' => false,
                    'multiple' => false
                   )
            )
            ->add('idinter', EntityType::class, 
            array(
             'class' => Intervenants::class,
             'choice_label' => 'idusers.nom',
             'expanded' => false,
             'multiple' => false
            )
     );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
