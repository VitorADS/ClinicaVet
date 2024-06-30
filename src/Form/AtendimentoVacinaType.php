<?php

namespace App\Form;

use App\Entity\Atendimento;
use App\Entity\AtendimentoVacina;
use App\Entity\Vacina;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AtendimentoVacinaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('atendimento', EntityType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Selecione um atendimento'
                    ])
                ],
                'class' => Atendimento::class,
                'choice_label' => 'id',
            ])
            ->add('vacina', EntityType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Selecione uma vacina'
                    ])
                ],
                'class' => Vacina::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AtendimentoVacina::class,
            'csrf_protection' => false
        ]);
    }
}
