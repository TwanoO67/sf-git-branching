<?php

namespace App\ServerBundle\Form\Depot;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RepositoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('repo')
            ->add('nom')
            ->add('branching')
            ->add('deployInfo')
            ->add('deployMethod')
            ->add('path')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\ServerBundle\Entity\Depot\Repository'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_serverbundle_depot_repository';
    }
}
