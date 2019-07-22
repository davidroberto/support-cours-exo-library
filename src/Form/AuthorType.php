<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('firstname')

	        // j'ajoute le type DATETYPE sur le champs
            // et l'option 'widget' à single_text
            // pour avoir un calendrier à la place des boutons
	        // de sélection QUI SONT DEGUEULASSES
            ->add('birthdate', DateType::class, [
            	'widget' => 'single_text'
            ])

            ->add('deathdate', DateType::class, [
	            'widget' => 'single_text',
	             'required' => false
            ])
            ->add('biography')
	        ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
