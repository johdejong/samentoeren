<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ResidenceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ResidenceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ResidenceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Residence::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/residence');
        CRUD::setEntityNameStrings('plaats', 'Plaatsen');

        $this->crud->orderBy('residence', 'ASC');
        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('residence')->type('text')->label('Plaats');
        CRUD::column('country_id')->type('select')->label('Land')->attribute('name')->model('App\Models\Country');

        // Filters
  
        // Land
        $this->crud->addFilter([
            'name'  => 'country_id',
            'type'  => 'select2',
            'label' => 'Land',
            'placeholder' => 'Kies een land',
            ], function() {
                return \App\Models\Country::all()->pluck('name', 'id')->toArray();
            }, function($value) { 
                $this->crud->addClause('where', 'country_id', $value);
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ResidenceRequest::class);

        CRUD::field('residence')->type('text')->label('Plaats');
        CRUD::field('country_id')->type('select')->label('Land')->attribute('name')->model('App\Models\Country');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
      $this->crud->set('show.setFromDb', false);

      CRUD::column('id')->type('text')->label('Id');
      CRUD::column('residence')->type('text')->label('Plaats');
      CRUD::column('country_id')->type('select')->label('Land')->attribute('name')->model('App\Models\Country');
    }
}
