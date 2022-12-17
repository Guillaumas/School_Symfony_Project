<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Paddock;
use App\Entity\Space;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaddockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Area')
            ->add('Name')
            ->add('Space', EntityType::class, [
                'class' => Space::class,
                'choice_label' => "name",
                'multiple' => false,
                'expanded' => false
            ])
            ->add('MaxAnimals')
            ->add('Quarantine')
//            ->add('animals', EntityType::class, [
//                'class' => Animal::class,
//                'choice_label' => "name",
//                'multiple' => true,
//                'expanded' => true
//            ])
            ->add('OK', SubmitType::class, ["label" => "OK"]);;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paddock::class,
        ]);
    }
}
