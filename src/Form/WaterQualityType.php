<?php

namespace App\Form;

use App\Service\API\Entity\WaterQuality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WaterQualityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ph')
            ->add('kh')
            ->add('co2')
            ->add('no2')
            ->add('no3')
            ->add('fe');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WaterQuality::class,
        ]);
    }
}
