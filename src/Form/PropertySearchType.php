<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('couleur', NULL, [
                'label'=> false,
                'attr'=>[
                'placeholder'=> 'Rechercher par couleur']])
        ;
    }
/*
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
//            'method' => 'get',
            'method' => 'post',
            'csrf_protection' => false
        ]);
    }
*/
    public function getBlockPrefix(){
        return '';
    }
}
