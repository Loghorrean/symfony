<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AuthorType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->
            add('name', TextType::class,
            array('label' => 'Name of author',
                'attr' => array(
                    'class' => 'form-control')
            ))
            ->add('save', SubmitType::class,
                array('attr' => array(
                    'class' => 'btn btn-primary')
                ));
    }

    public function getName() : string {
        return 'author';
    }
}