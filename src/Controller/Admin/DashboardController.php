<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Purchase;
use App\Entity\SubCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Akishop');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Products', 'fa-solid fa-cube', Product::class);
        yield MenuItem::linkToCrud('Categories', 'fa-solid fa-layer-group', Category::class);
        yield MenuItem::linkToCrud('SubCategories', 'fa-solid fa-layer-group', SubCategory::class);
        yield MenuItem::linkToCrud('Purchases', 'fa-solid fa-cart-shopping', Purchase::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
    }
}
