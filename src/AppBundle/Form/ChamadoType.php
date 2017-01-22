<?php

namespace AppBundle\Form;

use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ChamadoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array('mapped' => false, 'label' => 'Nome:'))
            ->add('email', TextType::class, array('mapped' => false, 'label' => 'E-Mail:'))
            ->add('numeroPedido', TextType::class, array('mapped' => false, 'label' => 'Número do Pedido:'))
            ->add('titulo', TextType::class, array('label' => 'Titulo do Chamado:'))
            ->add('observacao', TextareaType::class, array('label' => 'Observações:'));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Chamados'
        ));
    }
}
