<?php
namespace App\Form\Type;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void 
    {
        $builder
        ->add('nom', Type\TextType::class, ['label' => "Nom : "])
        ->add('prenom', Type\TextType::class, ['label' => "Prénom : "])
        ->add(
        'date_naissance',
        Type\BirthdayType::class,
        ['label' => "Date de naissance : "],
        array(
        'required' => false,
        )
        )
        ->add('valider', Type\SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        'data_class' => Utilisateur::class,
        ]);
    }
}