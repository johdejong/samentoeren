<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DistancecategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class DistancecategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Distancecategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/distancecategory');
        CRUD::setEntityNameStrings('afstandscategorie', 'Afstandscategorieën');

        $this->crud->orderBy('distancecategory', 'ASC');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        CRUD::column('distancecategory')->label('Afstandscategorie')->type('text');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(DistancecategoryRequest::class);

        CRUD::field('distancecategory')->label('Afstandscategorie')->type('text');        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('distancecategory')->label('Afstandscategorie')->type('text');
    }
}