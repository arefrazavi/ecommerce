<?php
/**
 * Created by PhpStorm.
 * User: arefr
 * Date: 9/1/2018
 * Time: 9:15 AM
 */

namespace App\Admin;


use App\Entity\Product;
use App\Entity\Variant;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VariantAdmin extends AbstractAdmin
{
//    public function toString($object)
//    {
//        return $object instanceof Variant
//            ? $object->getId()
//            : 'Variant'; // shown in the breadcrumb on the create view
//    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('color', TextType::class);
        $formMapper->add('price', IntegerType::class);

    }
//
//    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//    {
//        $datagridMapper->add('title');
//        $datagridMapper->add('description');
//    }
//
//    protected function configureListFields(ListMapper $listMapper)
//    {
//        $listMapper->addIdentifier('title');
//        $listMapper->addIdentifier('description');
//    }

}