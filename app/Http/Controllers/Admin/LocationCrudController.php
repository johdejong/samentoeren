<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LocationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocationCrudController extends CrudController
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
      CRUD::setModel(\App\Models\Location::class);
      CRUD::setRoute(config('backpack.base.route_prefix') . '/location');
      CRUD::setEntityNameStrings('locatie', 'Locaties');

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
      CRUD::column('name')->type('text')->label('Naam locatie');
      CRUD::column('description')->type('textarea')->label('Omschrijving');
      CRUD::column('address')->type('text')->label('Adres');
      CRUD::column('postal_code')->type('text')->label('Postcode');
      CRUD::column('residence')->type('text')->label('Plaats');
      CRUD::column('country_id')->type('select')->label('Land')->attribute('name')->model('App\Models\Country');

      // Filters
      
      // Plaats
      $this->crud->addFilter([
        'name'  => 'residence',
        'type'  => 'select2',
        'label' => 'Plaats',
        'placeholder' => 'Kies een plaats',
        ], function() {
            return \App\Models\Location::all()->pluck('residence', 'residence')->toArray();
        }, function($value) { 
            $this->crud->addClause('where', 'residence', $value);
      });

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
      CRUD::setValidation(LocationRequest::class);

      CRUD::field('name')->type('text')->label('Naam locatie');
      CRUD::field('description')->type('textarea')->label('Omschrijving');
      CRUD::field('address')->type('text')->label('Adres');
      CRUD::field('postal_code')->type('text')->label('Postcode');
      CRUD::field('residence')->type('text')->label('Plaats');
      CRUD::field('latitude')->type('text')->label('Latitude');
      CRUD::field('longitude')->type('text')->label('Longitude');
      // CRUD::field('country_id')->type('select2')->label('Land')->attribute('name')->model('App\Models\Country');
      $this->crud->addField([
        'name' => 'country_id', 
        'type' => 'select2', 
        'label' => 'Land', 
        'default' => '1',
        'attribute' => 'name', 
        'model' => 'App\Models\Country',
        'options' => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }),
      ]);
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
      CRUD::column('name')->type('text')->label('Naam locatie');
      CRUD::column('description')->type('textarea')->label('Omschrijving');
      CRUD::column('address')->type('text')->label('Adres');
      CRUD::column('postal_code')->type('text')->label('Postcode');
      CRUD::column('residence')->type('text')->label('Plaats');
      CRUD::column('latitude')->type('text')->label('Latitude');
      CRUD::column('longitude')->type('text')->label('Longitude');
      CRUD::column('country_id')->type('select')->label('Land')->attribute('name')->model('App\Models\Country');
    }
}
