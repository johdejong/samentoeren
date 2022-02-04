<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TypeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Type::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/type');
        CRUD::setEntityNameStrings('toertype', 'Toertypes');

        $this->crud->orderBy('type', 'ASC');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        CRUD::column('type')->type('text')->label('Toertype');
        CRUD::column('description')->type('textarea')->label('Omschrijving');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TypeRequest::class);

        CRUD::field('type')->type('text')->label('Toertype');
        CRUD::field('description')->type('textarea')->label('Omschrijving');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('id')->label('Id')->type('text');
        CRUD::column('type')->type('text')->label('Toertype');
        CRUD::column('description')->type('textarea')->label('Omschrijving');
    }
}