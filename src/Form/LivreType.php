<?php
// LivreType.php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformer\TimestampToDateTimeTransformer;

class LivreType extends AbstractType
{
    private $transformer;

    public function __construct(TimestampToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre', TextType::class)
            ->add('Auteur', TextType::class)
            ->add('Description', TextareaType::class, [
                'required' => false,
            ])
            ->add('Date_de_Paruption', DateType::class, [
                'label' => 'Date de Parution',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de Parution',
                    'class' => 'form-control',
                ],
                'format' => 'yyyy-MM-dd', // Format de date en anglais
            ])
            ->add('ImageFile', FileType::class, [
                'required' => false,
            ])
            ->add('Pages_Nombres', TextType::class, [
                'required' => false,
            ])
            ->add('Categorie', ChoiceType::class, [
                'choices' => [
                    'Fantastique' => 'Fantastique',
                    'Poésie' => 'Poésie',
                    'Bande Déssinée' => 'Bande Déssinée',
                    'Chroniques' => 'Chroniques',
                    'Littérature jeunesse' => 'Littérature jeunesse',
                    'Science-fiction' => 'Science-fiction',
                    'Nouvelles' => 'Nouvelles',
                ],
            ])
            ->add('Statut', CheckboxType::class, [
                'required' => false,
            ])
            ->add('ISBN_Nombre', IntegerType::class)
            ->add('ID_Emprunteur', EntityType::class, [
                'class' => Membres::class,
                'choice_label' => 'Nom', // ou toute autre propriété que vous souhaitez afficher
                'required' => false, // Permettre la sélection d'aucun membre
            ])
            // Utilisez le Data Transformer pour le champ Date_de_Paruption
            ->get('Date_de_Paruption')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}