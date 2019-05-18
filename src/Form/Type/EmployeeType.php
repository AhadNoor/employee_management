<?php

namespace App\Form\Type;

use App\Entity\Employee;
use App\Validator\ContactNo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'min' => 6
                    ],
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'This value is required',
                            ]
                        ),
                        new Length(['min' => 6]),
                    ]
                ]
            )
            ->add(
                'designation',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'empty_data' => '',
                    'required'  => false,
                ]
            )
            ->add(
                'date_of_birth',
                DateType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'widget' => 'single_text',
                    'html5' => true,
                    'required'  => false,

                ]
            )
            ->add(
                'gender',
                ChoiceType::class,
                [
                    'choices' => [
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other',
                    ],
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'Gender is required',
                            ]
                        ),
                    ]
                ]
            )
            ->add(
                'contact_no',
                TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'empty_data' => '',
                    'constraints' => [
                        new ContactNo(),
                    ]

                ]
            )->add(
                'file',
                FileType::class,
                [
                    'data_class'=>null,
                    'required'  => false,
                ]
            )
            ->add(
                'avatar',
                HiddenType::class,
                [
                    'required'  => false,
                ]
            )
            ->add('note');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Employee::class,

            ]
        );
    }
}
