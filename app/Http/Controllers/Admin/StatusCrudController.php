<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StatusRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class StatusCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Status::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/status');
        CRUD::setEntityNameStrings('toerstatus', 'Toerstatussen');

        $this->crud->orderBy('status', 'ASC');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        CRUD::column('status')->type('text')->label('Toerstatus');
        CRUD::column('description')->type('textarea')->label('Omschrijving');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StatusRequest::class);

        CRUD::field('status')->type('text')->label('Toerstatus');
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
        CRUD::column('status')->type('text')->label('Toerstatus');
        CRUD::column('description')->type('textarea')->label('Omschrijving');
    }
}
