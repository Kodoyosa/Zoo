<?php

namespace Kodo\ZooBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimauxType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',    'text')
            ->add('datenaissance',  'birthday')
            ->add('description',    'textarea')
            ->add('genre', 'choice', array(
                'choices'   => array('m' => 'Mâle', 'f' =>'Femelle')
            ))
            ->add('photo',   'text')
            ->add('espece', 'entity', array(
                'class' =>  'KodoZooBundle:Especes',
                'property'  =>  'denomination',
            ))
            ->add('Valider',   'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kodo\ZooBundle\Entity\Animaux'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kodo_zoobundle_animaux';
    }
}
