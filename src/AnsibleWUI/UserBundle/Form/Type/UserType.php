<?php

namespace AnsibleWUI\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserType
 *
 * @package ProjectPreview\UserBundle\Form\Type
 */
class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add(
            'firstname',
            TextType::class, [
                'label' => 'First name',
            ]
        );

        $builder->add(
            'lastname',
            TextType::class, [
                'label' => 'Last name',
            ]
        );

        $builder->add(
            'username',
            TextType::class, [
                'label'    => 'Username',
            ]
        );

        $builder->add(
            'email',
            EmailType::class, [
                'label'    => 'Email',
            ]
        );

        $builder->add(
            'roles',
            ChoiceType::class, [
                'label'   => 'Roles',
                'choices' => [
                    'Administrator' => 'ROLE_ADMIN',
                    'User'          => 'ROLE_USER',
                ],
                'multiple' => true,
                'attr' => [
                    'data-tags' => '',
                ],
            ]
        );

        $builder->add(
            'plainPassword',
            RepeatedType::class, [
                'first_options'  => [
                    'label' => 'Password',
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                ],
                'type'           => PasswordType::class,
                'required'       => false,
            ]
        );

        $builder->add(
            'enabled',
            ChoiceType::class, [
                'label'   => 'Status',
                'choices' => [
                    'Enabled'  => 1,
                    'Disabled' => 0,
                ],
                'attr' => [
                    'data-tags' => '',
                ],
            ]
        );

        $builder->add(
            'submit',
            SubmitType::class, [
                'attr' => [
                    'class' => 'btn-sm btn-success',
                ],
            ]
        );

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => 'AnsibleWUI\UserBundle\Entity\User',
                'cascade_validation' => true,
            ]
        );
    }
}