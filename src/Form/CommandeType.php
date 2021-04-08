<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\StatutCommande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statutCommande', EntityType::class, [
                'class' => StatutCommande::class,
                'choice_label' => function(StatutCommande $t) {
                    return sprintf('%s', $t->getLibelle());
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
