<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Crud\ProductCrudController;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\ProductBrand;
use App\Entity\ProductCategory;
use App\Entity\ProductCharacteristics;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        // return parent::index();

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetWebS4');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Products'),
            MenuItem::linkToCrud('All product', 'fa fa-tag', Product::class),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', ProductCategory::class),
            MenuItem::linkToCrud('Brands', '', ProductBrand::class),
            MenuItem::linkToCrud('Characteristics', 'fa fa-list', ProductCharacteristics::class),

            MenuItem::section('Others'),
            MenuItem::linkToCrud('Orders', '', Order::class),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class)
        ];
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            -> addMenuItems([
                MenuItem::linkToRoute('Profile', '', ''),
                MenuItem::linkToRoute('Settings', '', '')
            ]);
    }
}
