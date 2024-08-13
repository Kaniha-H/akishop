<?php

namespace App\Controller\Admin;

use App\Entity\PurchaseItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PurchaseItemCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return PurchaseItem::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('productname'),
            IntegerField::new('productPirce'),
            IntegerField::new('quantity'),
            IntegerField::new('total'),
            AssociationField::new('product'),
            AssociationField::new('purchase'),
        ];
    }
}
