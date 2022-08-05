<?php

namespace App\Form;

use App\Entity\Todo;
use DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;


class TodoType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
      $builder
          ->add('name', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px', "placeholder"=>"Event Name"]
          ])
          ->add('date', DateTimeType::class, [
              'attr' => ['style' => 'margin-bottom:15px']
          ])
          ->add('description', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px', "placeholder"=>"Event Description"]
          ])
          ->add('picture', TextType::class, [
              'attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px']
          ])
          ->add('capacity', IntegerType::class, [
              'attr' => ['style' => 'margin-bottom:15px', "placeholder"=>"Event Capacity"]
          ])
          ->add('contact', TextType::class, [
              'attr' => ['style' => 'margin-bottom:15px', "placeholder"=>"Email"]
          ])
          ->add('phone', IntegerType::class, [
              'attr' => ['style' => 'margin-bottom:15px', "placeholder"=>"Phone Number"]
          ])
          ->add('location', TextType::class, [
              'attr' => ['style' => 'margin-bottom:15px', "placeholder"=>"Location"]
          ])
          ->add('url', TextType::class, [
              'attr' => ['style' => 'margin-bottom:15px', "placeholder"=>"Events URL"]
          ])
          ->add('type', ChoiceType::class, [
              'choices' => ['Concert' => 'Concert', 'Sport' => 'Sport', 'Film' => 'Film'],
              'attr' => ['style' => 'margin-bottom:15px']
          ])
          ->add('save', SubmitType::class, [
              'label' => 'Submit',
              'attr' => ['class' => 'btn btn-primary', 'style' => 'margin-bottom:15px']
          ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
      $resolver->setDefaults([
          'data_class' => Todo::class,
      ]);
  }
}