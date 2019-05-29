<?php

namespace UserBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('description', null, array(
            'label' => 'Sujet',
            'attr' => array('style' => 'height: 200px')
        ))->add('Owner', EntityType::class, array(
        'class' => 'UserBundle\Entity\User',
        'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('u')
                ->where('u.role= ?1')
                ->setParameter(1, 'provider')
                ->orderBy('u.username', 'ASC');
        },
        'choice_label' => 'username',
        'multiple' => false,
    ))->add('image', FileType::class, array('label' => 'Brochure (PDF file)'))->add('location')->add('Add', SubmitType::class);;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Entreprise'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_entreprise';
    }


}
