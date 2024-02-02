<?php

namespace App\Form;

use App\DTO\SuggererFilmDTO;
use App\DTO\Version;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuggererFilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'attr'=>[
                    'rows'=>4
                ]
            ])
            ->add('dateDeSortie', DateType::class, [

            ])
            ->add('genre', EntityType::class, [
                'class'=>Genre::class,
                'choice_label'=>'nom'
            ])
            ->add('version', EnumType::class, [
                'class'=>Version::class,
                'required'=>false,
                'expanded'=>true
            ])
            ->add('votreMail', EmailType::class)
            ->add('fichierJoint', FileType::class)
            ->add('envoyer', SubmitType::class, ['label'=>'Cliquez pour envoyer !'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SuggererFilmDTO::class,
        ]);
    }
}
