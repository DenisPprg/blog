<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class PostForm
 * @package App\Form
 */
class PostForm extends AbstractType
{
//    /**
//     * @var TranslatorInterface
//     */
//    private $translator;
//
//    /**
//     * PostForm constructor.
//     * @param TranslatorInterface $translator
//     */
//    public function __construct(TranslatorInterface $translator)
//    {
//        $this->translator = $translator;
//    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name', TextType::class, [
            'required' => false,
            'label' => 'Post name',
        ]);
        $builder->add('description', TextareaType::class);
        $builder->add('publishedAt', DateType::class, [
            'widget' => 'single_text',
        ]);
        $builder->add('submit', SubmitType::class);
    }

//    /**
//     * @param OptionsResolver $resolver
//     * @return void
//     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => Post::class,
//        ));
//    }
}
