<?php

namespace App\Form;

use App\Entity\Casting;
use App\Entity\Film;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CastingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('filmsRealises', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('filmsInterpretes', EntityType::class, [
                'class' => Film::class,
                'choice_label' => 'id',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Casting::class,
        ]);
    }
}
