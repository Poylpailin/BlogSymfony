<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleAdmin extends Admin
{

    /**
     * // Fields to be shown on create/edit forms
     *
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('content')
            ->add('date')
            ->add('categories')
            ->add('tags')
            ->add('user')
        ;
    }

    /**
     * Fields to be shown on filter forms
     *
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('user')
            ->add('date')
        ;
    }
    /**
     * // Fields to be shown on lists
     *
     * {@inheritdoc}
     *
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title')
            ->add('content')
            ->add('user')
            ->add('date')
            ->add('categories')
            ->add('tags')
        ;
    }

    /**
     * Fields to be shown on show action
     *
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('content')
            ->add('date')
            ->add('categories')
            ->add('tags')
            ->add('user')
        ;
    }
}