<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre', TextType::class)
            ->add('Auteur', TextType::class)
            ->add('Description', TextareaType::class, [
                'required' => false,
            ])
            ->add('Date_de_Paruption', IntegerType::class)
            
            ->add('ImageFile', FileType::class, [
                'required' => false,
            ])
            ->add('Pages_Nombres', TextType::class, [
                'required' => false,
            ])
            ->add('Categorie', ChoiceType::class, [
                'choices' => [
                    'Categorie 1' => 'Categorie 1',
                    'Categorie 2' => 'Categorie 2',
                    'Categorie 3' => 'Categorie 3',
                ],
            ])
            ->add('Statut', CheckboxType::class, [
                'required' => false,
            ])
            ->add('ISBN_Nombre', IntegerType::class);
            // // // Ajoutez d'autres champs au besoin
            // // ->add('ID_Emprunteur', EntityType::class, [
            // //     'class' => Membres::class,
            // //     'choice_label' => 'nom', // Ajustez cela en fonction de votre entité Membres
            // //     'required' => false,
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}