<?php

namespace App\Form;

use App\Entity\Pet;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Security\Core\Security;

class PetType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('description')
            // ->add('user', HiddenType::class, [
            //     'class' => User::class,
            //     'data' => $this->security->getUser()->getId(),
            // ])

            // $builder->add('users', EntityType::class, [
            //     'class' => User::class,
            //     'query_builder' => function (EntityRepository $er) {
            //         return $er->createQueryBuilder('u')
            //             ->orderBy('u.username', 'ASC');
            //     },
            //     'choice_label' => 'username',
            // ]);

            ->add('user', EntityType::class, [
                  // looks for choices from this entity
                  'class' => User::class,
                  'query_builder' => function (UserRepository $er) {
                      return $er->createQueryBuilder('u')
                          ->where('u.id = :userId')
                          ->setParameters(array('userId' => $this->security->getUser()->getId())) ;
                  },

                  // uses the User.username property as the visible option string
                  'choice_label' => 'username',

                  // used to render a select box, check boxes or radios
                  // 'multiple' => true,
                  // 'expanded' => true,
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pet::class,
        ]);
    }
}
