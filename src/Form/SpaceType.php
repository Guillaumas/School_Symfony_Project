<?php

namespace App\Form;
use App\Entity\Space;
use App\Entity\Paddock;

use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('size')
            ->add('openDate', DateType::class,['widget' => 'single_text',
                'attr' => ['min' => '1980-01-01', 'max' => '2100-01-01'],])
            ->add('closeDate', DateType::class,['widget' => 'single_text',
                'attr' => ['min' => '1980-01-01', 'max' => '2100-01-01'],])
            // BY SIMON //
            ->add('paddocks', EntityType::class, [
                'class' => Paddock::class,
                'choice_label' => "name",
                'multiple' => false,
                'expanded' => false,
                'mapped' => false
            ])
            ->add('OK', SubmitType::class, ["label" => "OK"]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Space::class,
        ]);
    }
}