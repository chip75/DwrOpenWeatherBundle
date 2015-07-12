<?php
namespace Dwr\GlobalWeatherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GlobalWeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('location', 'choice', array(
            'choice_list' => new LocationChoice()
        ))
        ->add('submit', 'submit')
        ;
    }

    public function getName()
    {
        return 'global_weather';
    }
}