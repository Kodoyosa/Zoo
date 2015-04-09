<?php

namespace Kodo\ZooBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimauxModifierType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datedeces',  'date')
            ->remove('datenaissance',  'date')
            ->remove('genre', 'choice', array(
                'choices'   => array('m' => 'Mâle', 'f' =>'Femelle')
            ))
            ->remove('photo',   'text')
            ->remove('espece', 'entity', array(
                'class' =>  'KodoZooBundle:Especes',
                'property'  =>  'denomination',
            ))
            ->remove('Valider',   'submit')
            ->add('Valider',   'submit')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kodo_zoobundle_animaux_modifier';
    }
    public function getParent()
    {
        return new AnimauxType();
    }
}
