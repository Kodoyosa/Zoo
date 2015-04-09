<?php
namespace Kodo\ZooBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnimauxSoigneurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('soigneur',    'entity', array(
                'class' =>  'KodoZooBundle:Soigneurs',
                'property'  => 'pseudo',
            ))
            ->add('animal',  'entity', array(
                'class' =>  'KodoZooBundle:Animaux',
                'property'  =>  'nom'
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
            'data_class' => 'Kodo\ZooBundle\Entity\Soccuper'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kodo_zoobundle_soccuper';
    }
}