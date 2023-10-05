<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Conference Comment')
            ->setEntityLabelInPlural('Conference Comments')
            ->setSearchFields(['author', 'text', 'email'])
            ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
{
    return $actions
        // ...
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
    ;
}

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('conference'))
        ;
    }


    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('conference');
        yield TextField::new('author');
        yield EmailField::new('email');
        yield TextareaField::new('text')
            ->hideOnIndex();
        yield ImageField::new('photoFilename')
            ->setBasePath('/uploads/photos')
            ->setLabel('Photo')
            ->onlyOnIndex();
        yield DateTimeField::new('createdAt')->hideOnForm();
    }
}
