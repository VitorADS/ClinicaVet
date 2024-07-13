<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Raca;
use App\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => 'Nome',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Digite o nome'
                    ])
                ]
            ])
            ->add('cor', TextType::class, [
                'label' => 'Cor',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Digite a cor'
                    ])
                ]
            ])
            ->add('peso', NumberType::class, [
                'label' => 'Peso',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Insira o peso'
                    ]),
                ]
            ])
            ->add('altura', NumberType::class, [
                'label' => 'Altura',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Insira a altura'
                    ]),
                ]
            ])
            ->add('dataNascimento', DateType::class, [
                'label' => 'Data de nascimento',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Informe a data de nascimento'
                    ])
                ]
            ])
            ->add('tipo', EntityType::class, [
                'label' => 'Porte',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Informe o porte'
                    ]),
                ],
                'class' => Tipo::class,
                'choice_label' => function (Tipo $tipo): string {
                    return $tipo;
                }
            ])
            ->add('raca', EntityType::class, [
                'label' => 'Raca',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Informe a raca'
                    ]),
                ],
                'class' => Raca::class,
                'choice_label' => function (Raca $raca): string {
                    return $raca;
                }
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
            'data_class' => Animal::class,
            'editar' => false
        ]);
    }
}
