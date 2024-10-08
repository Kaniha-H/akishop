<?php 

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait ReadOnlyTrait
{
    public function ConfigureActions(Actions $actions): Actions
    {
        // ->disable(Action::NEW, Action::EDIT, Action::DELETE)
        $actions->add(Crud::PAGE_INDEX, Action::DETAIL);

        return $actions;
    }
}