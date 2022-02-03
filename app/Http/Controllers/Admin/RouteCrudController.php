<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RouteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Route;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\File;

/**
 * Class RouteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RouteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }

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
        CRUD::setModel(\App\Models\Route::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/route');
        CRUD::setEntityNameStrings('route', 'Routes');

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
        CRUD::column('distance')->type('number')->label('Afstand')->suffix(' km');
        CRUD::column('distancecategory_id')->type('select')->label('Afstandscategorie')->attribute('distancecategory')->model('App\Models\Distancecategory');
        CRUD::column('start_residence_id')->entity('start_residence')->type('select')->label('Plaats van vertrek')->attribute('residence')->model('App\Models\Residence');
        CRUD::column('finish_residence_id')->entity('finish_residence')->type('select')->label('Plaats van aankomst')->attribute('residence')->model('App\Models\Residence');
                
        $this->crud->addButtonFromView('line', 'kaart', 'kaart', 'beginning');

        // Filters

        // Afstandscategorie
        $this->crud->addFilter([
            'name'  => 'distancecategory_id',
            'type'  => 'select2',
            'label' => 'Afstandscategorie',
            'placeholder' => 'Kies een afstandscategorie',
            ], function() {
                return \App\Models\Distancecategory::all()->pluck('distancecategory', 'id')->toArray();
            }, function($value) {
                $this->crud->addClause('where', 'distancecategory_id', $value);
        });

        // Plaats van vertrek
        $this->crud->addFilter([
            'name'  => 'start_residence_id',
            'type'  => 'select2',
            'label' => 'Plaats van vertrek',
            'placeholder' => 'Kies een plaats van vertrek',
            ], function() {
                return \App\Models\Residence::all()->pluck('residence', 'id')->toArray();
            }, function($value) {
                $this->crud->addClause('where', 'start_residence_id', $value);
        });

        // Plaats van aankomst
        $this->crud->addFilter([
            'name'  => 'finish_residence_id',
            'type'  => 'select2',
            'label' => 'Plaats van aankomst',
            'placeholder' => 'Kies een plaats van aankomst',
            ], function() {
                return \App\Models\Residence::all()->pluck('residence', 'id')->toArray();
            }, function($value) {
                $this->crud->addClause('where', 'finish_residence_id', $value);
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
        CRUD::setValidation(RouteRequest::class);

        CRUD::field('name')->label('Naam')->type('text');
        CRUD::field('description')->label('Omschrijving')->type('textarea');
        CRUD::field('distance')->type('number')->label('Afstand')->suffix(' km');
        CRUD::field('distancecategory_id')->type('select')->label('Afstandscategorie')->attribute('distancecategory')->model('App\Models\Distancecategory');
        CRUD::field('start_residence_id')->entity('start_residence')->type('select')->label('Plaats van vertrek')->attribute('residence')->model('App\Models\Residence');
        CRUD::field('finish_residence_id')->entity('finish_residence')->type('select')->label('Plaats van aankomst')->attribute('residence')->model('App\Models\Residence');
        CRUD::field('image')->label('Track')->type('upload')->upload(true)->disk('gpx');
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

        CRUD::column('id')->label('ID')->type('text');
        CRUD::column('name')->label('Naam')->type('text');
        CRUD::column('description')->label('Omschrijving')->type('textarea');
        CRUD::column('distance')->type('number')->label('Afstand')->suffix(' km');
        CRUD::column('distancecategory_id')->type('select')->label('Afstandscategorie')->attribute('distancecategory')->model('App\Models\Distancecategory');
        CRUD::column('start_residence_id')->entity('start_residence')->type('select')->label('Plaats van vertrek')->attribute('residence')->model('App\Models\Residence');
        CRUD::column('finish_residence_id')->entity('finish_residence')->type('select')->label('Plaats van aankomst')->attribute('residence')->model('App\Models\Residence');
        CRUD::column('image')->label('Track')->type('text');
    }

    public function store()
    {
        $response = $this->traitStore();

        // Na het opslaan bestandkenmerken toevoegen aan het record
        $route = Route::find($this->crud->entry->id);
        $image = $route->image;

        $size = Storage::disk('gpx')->size($route->image);
        $mimetype = Storage::disk('gpx')->getMimetype($route->image);
        $path = Storage::disk('gpx')->path($route->image);

        $route->size = $size;
        $route->mimetype = $mimetype;
        $route->path = $path;

        $route->save();

        return $response;
    }

    public function kaart($id)
    {
        $route = Route::find($id);
        return view('vendor.backpack.base.map', $route);
    }

    protected function download($id)
    {
        $route = Route::find($id);
        $download = 'storage/' . $route->image;

        return response()->download($download);
    }
}
