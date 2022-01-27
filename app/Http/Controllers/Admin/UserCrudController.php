<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('gebruiker', 'Gebruikers');

        $this->crud->orderBy('name', 'ASC');
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
        CRUD::column('name')->label('Naam')->type('text');
        CRUD::column('email')->label('E-mailadres')->type('email');
        CRUD::column('admin')->label('Beheerder')->type('boolean');
        CRUD::column('active')->label('Actief')->type('boolean');

        // Filters

        // Beheerder
        $this->crud->addFilter([
            'type'  => 'simple',
            'name'  => 'admin',
            'label' => 'Beheerder'
        ], 
        false, 
        function() {
            $this->crud->addClause('where', 'admin', '1');
        });

        // Actief
        $this->crud->addFilter([
                'type'  => 'simple',
                'name'  => 'active',
                'label' => 'Actief'
            ], 
            false, 
            function() {
                $this->crud->addClause('where', 'active', '1');
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
        CRUD::setValidation(UserRequest::class);

        CRUD::field('name')->label('Naam')->type('text');
        CRUD::field('email')->label('E-mailadres')->type('email');
        // CRUD::field('password')->label('Wachtwoord')->type('password');
        CRUD::field('admin')->label('Beheerder')->type('toggle')->view_namespace('toggle-field-for-backpack::fields');
        CRUD::field('active')->label('Actief')->type('toggle')->view_namespace('toggle-field-for-backpack::fields');
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

      CRUD::column('id')->label('Id')->type('text');
      CRUD::column('name')->label('Naam')->type('text');
      CRUD::column('email')->label('E-mailadres')->type('email');
      CRUD::column('admin')->label('Beheerder')->type('boolean');
      CRUD::column('active')->label('Actief')->type('boolean');
    }
}
