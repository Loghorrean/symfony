<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) : void {
        $builder->
            add('title', TextType::class,
            array('label' => 'Title of the book',
                'attr' => array(
                    'class' => 'form-control')
            ))
            ->add('date_of_publish', DateType::class,
            array('label' => 'Date of publishing the book',
                'attr' => array(
                    'class' => 'form-control')
            ))
            ->add('save', SubmitType::class,
            array('attr' => array(
                'class' => 'btn btn-primary'
            )
            ));
    }

    public function getName() : string {
        return 'book';
    }
}