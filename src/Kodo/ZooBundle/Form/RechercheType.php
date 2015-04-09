<?php
namespace Kodo\ZooBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add('recherche', 'text', array(
            'label' => false,
            'attr' => array('class' => 'form-control')
        ));
    }

    public function getName()
    {
        return 'kodo_zoo_recherche';
    }
}