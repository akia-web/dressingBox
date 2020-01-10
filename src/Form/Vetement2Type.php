<?php

namespace App\Form;

use App\Entity\Vetement2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Vetement2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie',  ChoiceType::class,[
                'choices'  => [
                    'haut'=>'haut',
                    'bas' => 'bas',
                    'chaussure' => 'chaussure',
                ]
            ])
            ->add('couleur', ChoiceType::class,[
                'choices'=>[
                    'noir'=>'noir',
                    'rouge'=>'rouge',
                    'bleu' =>'bleu',
                    'blanc'=>'blanc',
                ]
            ])
            ->add('taille', ChoiceType::class,[
                'choices'=>[
                    '--'=>'',
                    'xs'=>'xs',
                    's' =>'s',
                    'm'=>'m',
                    'l'=>'l',
                    'xl'=>'xl',
                    'xxl' =>'xxl',
                ]
            ])
            ->add('style', ChoiceType::class,[
                'choices'=>[
                    'sportware'=>'sportware',
                    'classic'=>'classic',
                    'chic' =>'chic',
                    'cocooning'=>'cocooning',
                ]
            ])
            ->add('marque')
            ->add('photo')
            ->add('client_id')
            ->add('ajouter', submitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vetement2::class,
        ]);
    }
}
