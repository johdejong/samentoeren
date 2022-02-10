<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CountryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Country::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/country');
        CRUD::setEntityNameStrings('land', 'Landen');

        $this->crud->orderBy('name', 'ASC');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        CRUD::column('code')->label('Landcode')->type('text');
        CRUD::column('name')->label('Land')->type('text');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CountryRequest::class);

        CRUD::field('code')->type('text')->label('Landcode');
        CRUD::field('name')->type('text')->label('Land');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('id')->label('Id')->type('text');
        CRUD::column('code')->label('Landcode')->type('text');
        CRUD::column('name')->label('Land')->type('text');
    }
}
