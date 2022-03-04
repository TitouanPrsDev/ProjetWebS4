<?php

namespace App\Controller\Admin\Crud;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud-> setPageTitle('index', '%entity_label_plural%s list');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id') -> hideOnForm(),
            EmailField::new('email'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            ImageField::new('profilePicture')
                -> setUploadDir('public/images/users')
                -> setUploadedFileNamePattern('[year][month][day]_[timestamp].[extension]')
                -> hideOnIndex(),
            ChoiceField::new('roles') -> setChoices([
                'Client' => 'ROLE_USER',
                'Administrateur' => 'ROLE_ADMIN'
            ]) -> allowMultipleChoices()
        ];
    }
}
