<?php

namespace App\Form;

use App\Entity\Vetement2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Vetement2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie')
            ->add('couleur')
            ->add('taille')
            ->add('style')
            ->add('marque')
            ->add('photo')
            ->add('client_id')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vetement2::class,
        ]);
    }
}
