<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ResidenceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ResidenceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Residence::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/residence');
        CRUD::setEntityNameStrings('plaats', 'Plaatsen');

        $this->crud->orderBy('residence', 'ASC');
        $this->crud->enableExportButtons();
    }

    protected function setupListOperation()
    {
        CRUD::column('residence')->type('text')->label('Plaats');
        CRUD::column('country_id')->type('select')->label('Land')->attribute('name')->model(\App\Models\Country::class);

        // Filters
        // Land
        $this->crud->addFilter([
            'name'  => 'country_id',
            'type'  => 'select2',
            'label' => 'Land',
            'placeholder' => 'Kies een land',
        ], function () {
                return \App\Models\Country::all()->pluck('name', 'id')->toArray();
            }, function ($value) {
                $this->crud->addClause('where', 'country_id', $value);
            });
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ResidenceRequest::class);

        CRUD::field('residence')->type('text')->label('Plaats');
        $this->crud->addField([
            'name' => 'country_id',
            'type' => 'select2',
            'label' => 'Land',
            'default' => '1',
            'attribute' => 'name',
            'model' => \App\Models\Country::class,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('id')->type('text')->label('Id');
        CRUD::column('residence')->type('text')->label('Plaats');
        CRUD::column('country_id')->type('select')->label('Land')->attribute('name')->model(\App\Models\Country::class);
    }
}
