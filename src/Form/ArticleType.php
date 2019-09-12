<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('libelle', NULL,['label' => 'Designation:'])
            ->add('couleur', NULL,['label' => 'Couleur:'])
            ->add('categorie',  EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'designation',
            'placeholder' => 'Sélectionner une catégorie', ])
        ;

    }




    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
