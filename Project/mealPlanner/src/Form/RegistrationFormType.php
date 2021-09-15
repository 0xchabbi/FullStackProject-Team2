<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', TextType::class, array('attr' => array("class" => "form-control", "style" => "margin-bottom: 15px;")))
        ->add("avatar", FileType::class, array('attr'=>array("class"=>"form-control", "style"=>"margin-bottom:15px"), 'label' => 'Image (png/jpg file)', 'mapped'=> false, 'required'=> false, 'constraints'=>[ new File(['maxSize' =>'2048k', 'mimeTypes' => ['image/*'], 'mimeTypesMessage' =>'Please upload a valid image document',])]))
            ->add('email', TextType::class, array('attr' => array("class" => "form-control", "style" => "margin-bottom: 15px;")))
            ->add('agreeTerms', CheckboxType::class, [ 'attr' => array("class" => "form-check-input", "style" => "margin-bottom: 15px;"),
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ["class" => "form-control", "style" => "margin-bottom: 15px;", 'autocomplete' => 'new-password'],
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
            
        ;
        
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
