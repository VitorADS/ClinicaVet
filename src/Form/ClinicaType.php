<?php

namespace App\Form;

use App\Entity\Clinica;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ClinicaType extends AbstractType
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
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Digite o e-mail'
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
            ->add('submit', SubmitType::class, [
                'label' => $options['editar'] ? 'Editar' : 'Criar',
                'attr' => [
                    'class' => 'btn-secondary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clinica::class,
            'editar' => false
        ]);
    }
}
