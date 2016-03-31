<?php
/**
 * Created by PhpStorm.
 * User: Christopher
 * Date: 3/30/2016
 * Time: 10:47 AM
 */

namespace InventarioBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovimientoInventarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("tipoMovimiento", ChoiceType::class, array(
                "choices" => array(
                    "0" => "Ingreso",
                    "1" => "Egreso"
                )
            ))
            ->add("bodega", EntityType::class, array(
                'class' => 'AdministracionBundle\Entity\Bodega',
                'choice_label' =>  'nombre'
            ))
            ->add("motivoMovimiento", EntityType::class, array(
                'class' => 'ControlPanelBundle\Entity\MotivoMovimientoInventario',
                'choice_label' => 'nombre'
            ))
            ->add("movimientosMateriales", CollectionType::class, array(
                'entry_type' => MovimientoInventarioType::class
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InventarioBundle\Entity\MovimientoInventario',
            'is_edit' => false,
            'csrf_protection' => false,
        ));
    }

    public function getName() {
        return 'movimiento';
    }
}