<?php

namespace App\Controller\Admin\Crud;

use App\Entity\ProductCharacteristics;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCharacteristicsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductCharacteristics::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud-> setPageTitle('index', 'Product characteristics list');
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
