<?php

namespace App\Form;

use App\Entity\Papel;
use App\Entity\Profissional;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PapelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('periodoInicial', null, [
                'widget' => 'single_text',
            ])
            ->add('periodoFinal', null, [
                'widget' => 'single_text',
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Permissoes',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Selecione um'
                    ])
                ],
                'choices' => $options['papeis'],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('ativo')
            ->add('profissional', EntityType::class, [
                'class' => Profissional::class,
                'choice_label' => function (Profissional $profissional): string {
                    return (string) $profissional;
                },
                'multiple' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['editar'] ? 'Salvar' : 'Criar',
                'attr' => [
                    'class' => 'btn-secondary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Papel::class,
            'papeis' => [],
            'editar' => false
        ]);
    }
}
