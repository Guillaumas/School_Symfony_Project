<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identificationNumber')
            ->add('name')
            ->add('brithDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('arrivalDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['min' => '1980-01-01', 'max' => '2100-01-01',],
            ])
            ->add('departureDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('type')
            ->add('property')
            ->add('species')
            ->add('gender', ChoiceType::class, [
                'label' => "Sex",
                'choices' => [
                    "Male" => "male",
                    "Female" => "female",
                    "Undefined" => "undefined"
                ],
            ])
            ->add('sterilized')
            ->add('quarantaine')
            ->add('OK', SubmitType::class, ["label" => "OK"]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
