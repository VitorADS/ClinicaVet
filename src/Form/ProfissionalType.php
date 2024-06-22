<?php

namespace App\Form;

use App\Entity\Profissional;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfissionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => 'Nome',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Digite seu nome'
                    ])
                ]
            ])
            ->add('telefone', TextType::class, [
                'label' => 'Telefone',
                'required' => true,
                'attr' => [
                    'minlength' => 11,
                    'maxlength' => 11
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Digite seu telefone'
                    ]),
                    new Length([
                        'min' => 11,
                        'max' => 11,
                        'minMessage' => 'Digite 11 caracteres',
                        'maxMessage' => 'Digite 11 caracteres'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Informe um e-mail valido'
                    ])
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Senhas nao coincidem',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Digite sua senha'
                    ]),
                    new Length([
                        'min' => 6
                    ])
                ],
                'first_options' => ['label' => 'Senha'],
                'second_options' => ['label' => 'Confirme sua senha']
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
            'data_class' => Profissional::class,
            'editar' => false
        ]);
    }
}
