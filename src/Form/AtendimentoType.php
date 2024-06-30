<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Atendimento;
use App\Entity\Clinica;
use App\Entity\Pagamento;
use App\Entity\ProfissionalClinica;
use App\Entity\StatusAtendimento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AtendimentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('observacoes', TextType::class, [
                'label' => 'Observacoes',
                'required' => false
            ])
            ->add('descricao', TextType::class, [
                'label' => 'Descricao',
                'required' => false
            ])
            ->add('data', DateType::class, [
                'label' => 'Data do atendimentoi',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Informe a data do atendimento'
                    ])
                ]
            ])
            ->add('animal', EntityType::class, [
                'label' => 'Animal',
                'class' => Animal::class,
                'choice_label' => function (Animal $animal): string {
                    return $animal;
                }
            ])
            ->add('clinica', EntityType::class, [
                'class' => Clinica::class,
                'choices' => $options['clinica'],
                'choice_label' => function (Clinica $clinica): string {
                    return $clinica;
                }
            ])
            ->add('profissionalClinica', EntityType::class, [
                'class' => ProfissionalClinica::class,
                'choices' => $options['profissionaisClinica'],
                'choice_label' => function (ProfissionalClinica $profissionalClinica): string {
                    return $profissionalClinica->getProfissional();
                }
            ])
            ->add('statusAtendimento', EntityType::class, [
                'class' => StatusAtendimento::class,
            ])
            ->add('pagamento', EntityType::class, [
                'class' => Pagamento::class,
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
            'data_class' => Atendimento::class,
            'editar' => false,
            'profissionaisClinica' => [],
            'clinica' => null
        ]);
    }
}
