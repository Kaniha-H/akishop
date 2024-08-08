<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    // use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('price'),
            TextEditorField::new('description'),
            ImageField::new('picture')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]'),
            TextField::new('slug'),
            AssociationField::new('subCategory')->autocomplete()
        ];
    }
}
