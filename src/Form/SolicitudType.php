<?php

namespace App\Form;

use App\Entity\Medio;
use App\Entity\Solicitud;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolicitudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaUso', null, [
                'widget' => 'single_text',
            ])
            ->add('horaInicio', null, [
                'widget' => 'single_text',
            ])
            ->add('horaFin', null, [
                'widget' => 'single_text',
            ])
            ->add('estado')
            ->add('datetime', null, [
                'widget' => 'single_text',
            ])
            ->add('usuario', EntityType::class, [
                'class' => Usuario::class,
                'choice_label' => 'id',
            ])
            ->add('medio', EntityType::class, [
                'class' => Medio::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Solicitud::class,
        ]);
    }
}
