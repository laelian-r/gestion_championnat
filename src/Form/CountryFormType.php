<?php
namespace App\Form;

use App\Entity\Country;
use App\Entity\Team;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;

class CountryFormType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du pays'
            ])
            ->add('team_name', TextType::class, [
                'label' => 'Nom de l\'équipe',
                'mapped' => false, // Important !
            ])
            ->add('team_creation_date', DateType::class, [
                'label' => 'Date de création',
                'mapped' => false,
                'widget' => 'single_text', // Pour un input type="date"
                'required' => false,
            ])
            ->add('team_stade', TextType::class, [
                'label' => 'Stade',
                'mapped' => false,
                'required' => false,
            ])
            ->add('team_logo', FileType::class, [
                'label' => 'Logo',
                'mapped' => false,
                'required' => true,
            ])
            ->add('team_president', TextType::class, [
                'label' => 'Président',
                'mapped' => false,
                'required' => false,
            ])
            ->add('team_coach', TextType::class, [
                'label' => 'Entraîneur',
                'mapped' => false,
                'required' => false,
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Country::class,
            'csrf_protection' => false,
            'attr' => [
                'enctype' => "multipart/form-data"
            ]
        ]);
    }
}
