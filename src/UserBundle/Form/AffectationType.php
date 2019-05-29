<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')->add('middlename')->add('lastname')->add('college')->add('phone')->add('email', EmailType::class)->add('department',ChoiceType::class, array(
            'choices'  => array(
                'Department finance' => 'Department finance',
                'Department IT' => 'Department IT',
                'Department sales' => 'Department sales',
            ),
        ))->add('level', ChoiceType::class, array(
            'choices'  => array(
                'Graduated' => 'Graduated',
                'UnderGraduated' => 'UnderGraduated',
                'Bigger' => 'Bigger',
            ),
        ))->add('hours')->add('course')->add('save',SubmitType::class, array(
            'attr' => array('class' => 'save')));;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Affectation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_affectation';
    }


}
