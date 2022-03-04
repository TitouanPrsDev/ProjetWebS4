<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ProductBrand;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductBrandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductBrand::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud-> setPageTitle('index', 'Product brands list');
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
