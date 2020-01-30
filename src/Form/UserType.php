<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\BlobType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar', TextareaType::class,['label' => 'Avatar'])
            ->add('nickname', TextType::class, ['label' => 'Surnom'])
            ->add('email', EmailType::class,['label' => 'Email'])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de Passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('personaldescription', TextType::class,['label' => 'Description Personnelle'])
            ->add('video', TextType::class,['label' => 'Vidéo de votre activité'])
            ->add('categoryactivity',TextType::class,['label' => ''])
            ->add('ownactivity',TextType::class,['label' => 'Votre spécialité'])
            ->add('descriptionownactivity',TextType::class,['label' => 'Description de votre numéro'])
            ->add('picture',TextType::class,['label' => 'Photo de votre spectacle'])
            //->add('showsactor',ChoiceType::class,['label' => 'Description Personnelle'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
