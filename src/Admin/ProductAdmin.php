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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getId()
            : 'Product'; // shown in the breadcrumb on the create view
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', TextType::class);
        $formMapper->add('description', TextType::class);
        $formMapper->add('variants', CollectionType::class,
            [
                'by_reference' => false,
                'required' => false,
                'type_options' => [
                    'delete' => true,
                ]
            ],
            [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'id',
            ]
        );

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->addIdentifier('description');
    }

    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    public function preUpdate($object)
    {
        foreach ($object->getVariants() as $variant) {
            $object->addVariant($variant);
        }
    }
}