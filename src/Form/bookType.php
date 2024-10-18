<?php
namespace App\Form;
use App\Entity\Author;
use App\Entity\Book; // Assurez-vous que cette importation est correcte
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class bookType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Entrez le titre du livre',
                    'class' => 'form-control'
                ],
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,  // <-- Assurez-vous d'ajouter cette ligne
                'choice_label' => 'username',  // <-- Cela indique quelle propriété de l'entité Author doit être affichée
                'label' => 'Auteur',
                'placeholder' => 'Sélectionnez un auteur',  // Utiliser un placeholder pour une liste déroulante
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Science-Fiction' => 'Science-Fiction',
                    'Mystery' => 'Mystery',
                    'Autobiography' => 'Autobiography',
                ],
                'placeholder' => 'Choisissez une catégorie',
                'attr' => [
                    'class' => 'form-control'
                ],
            ]) ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
