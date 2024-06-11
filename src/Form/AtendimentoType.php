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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AtendimentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('observacoes')
            ->add('descricao')
            ->add('data', null, [
                'widget' => 'single_text',
            ])
            ->add('animal', EntityType::class, [
                'label' => 'Animal',
                'class' => Animal::class,
                'choice_label' => 'id',
            ])
            ->add('clinica', EntityType::class, [
                'class' => Clinica::class,
                'choice_label' => function (Clinica $clinica): string {
                    return $clinica;
                }
            ])
            ->add('profissionalClinica', EntityType::class, [
                'class' => ProfissionalClinica::class,
                'choice_label' => 'id',
            ])
            ->add('statusAtendimento', EntityType::class, [
                'class' => StatusAtendimento::class,
                'choice_label' => 'id',
            ])
            ->add('pagamento', EntityType::class, [
                'class' => Pagamento::class,
                'choice_label' => 'id',
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
            'data_class' => Atendimento::class,
            'editar' => false
        ]);
    }
}
