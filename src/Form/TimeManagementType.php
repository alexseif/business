<?php

namespace App\Form;

use App\Entity\TimeManagement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeManagementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('project')
            ->add('task')
            ->add('duration')
            ->add('completed', DateTimeType::class, [
                'required' => false,
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TimeManagement::class,
        ]);
    }
}
