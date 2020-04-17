<?php

namespace App\Form;

use App\Entity\Desire;
use App\Entity\PurchaseList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DesireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('step')
            ->add('purchase')
            ->add('purchase', EntityType::class, [
                // looks for choices from this entity
                'class' => PurchaseList::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'id',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Desire::class,
        ]);
    }
}
