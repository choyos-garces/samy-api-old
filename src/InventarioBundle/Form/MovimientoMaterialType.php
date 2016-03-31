<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/30/2016
 * Time: 11:11 AM
 */

namespace InventarioBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovimientoMaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("cantidad", NumberType::class)
            ->add("tipoMovimiento", ChoiceType::class, array(
                1 => "Ingreso",
                0 => "Egreso"
            ))
            ->add("material", EntityType::class, array(
                'class' => 'AdministracionBundle\Entity\Material',
                'choice_label' => 'nombre'
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InventarioBundle\Entity\MovimientoMaterial',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return '';
    }
}