<?php

namespace App\Form;

use App\DTO\FiltrerFilmDTO;
use App\Entity\Genre;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltrerFilmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('genre', EntityType::class, ['class'=>Genre::class, 'required'=>false])
            ->add('pays', EntityType::class, ['class'=>Pays::class, 'required'=>false])
            ->add('anneeDebut', IntegerType::class, ['required'=>false, 'attr'=>['min'=>1900, 'max'=>2030]])
            ->add('anneeFin', IntegerType::class, ['required'=>false, 'attr'=>['min'=>1900, 'max'=>2030]])
            ->add('titre', null, ['required'=>false])
            ->add('Filtrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FiltrerFilmDTO::class,
        ]);
    }
}
