<?php
namespace Dwr\GlobalWeatherBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;

class GlobalWeatherType extends AbstractType
{
    private $locationChoice;

    public function __construct(LazyChoiceList $locationChoice)
    {
        $this->locationChoice = $locationChoice;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('location', 'choice', array(
            'choice_list' => $this->locationChoice
        ))
        ->add('submit', 'submit')
        ;
    }

    public function getName()
    {
        return 'global_weather';
    }
}
