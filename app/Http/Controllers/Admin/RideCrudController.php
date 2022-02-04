<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RideRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

class RideCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Ride::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/ride');
        CRUD::setEntityNameStrings('toerrit', 'Toerenritten');

        $this->crud->orderBy('start_date', 'DESC');
        $this->crud->enableExportButtons();
        $this->crud->enableDetailsRow();
    }

    protected function setupListOperation()
    {
        CRUD::column('name')->type('text')->label('Naam toer');
        CRUD::column('type_id')->type('select')->label('Type')->attribute('type')->model('App\Models\Type');
        CRUD::column('status_id')->type('select')->label('Status')->attribute('status')->model('App\Models\Status');
        CRUD::column('start_date')->type('date')->label('Vertrekdatum');
        CRUD::column('distance')->type('number')->default('100')->label('Afstand')->suffix(' km');
        $this->crud->query->withCount('users'); 
        CRUD::column('users_count')->type('text')->label('Deelnemer(s)');
        $this->crud->query->withCount('routes'); 
        CRUD::column('routes_count')->type('text')->label('Route(s)');

        // Filters
        // Status
        $this->crud->addFilter([
            'name'  => 'status_id',
            'type'  => 'select2',
            'label' => 'Status',
            'placeholder' => 'Kies een status',
            ], function() {
                return \App\Models\Status::all()->pluck('status', 'id')->toArray();
            }, function($value) {
                $this->crud->addClause('where', 'status_id', $value);
        });

        // Type
        $this->crud->addFilter([
            'name'  => 'type_id',
            'type'  => 'select2',
            'label' => 'Type',
            'placeholder' => 'Kies een type',
            ], function() {
                return \App\Models\Type::all()->pluck('type', 'id')->toArray();
            }, function($value) {
                $this->crud->addClause('where', 'type_id', $value);
        });

        // Datum
        $this->crud->addFilter([
            'type'  => 'date_range',
            'name'  => 'from_to',
            'label' => 'Datumbereik'
            ],
            false,
            function ($value) {
                $dates = json_decode($value);
                $this->crud->addClause('where', 'start_date', '>=', $dates->from);
                $this->crud->addClause('where', 'start_date', '<=', $dates->to . ' 23:59:59');
        });
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(RideRequest::class);

        CRUD::field('name')->type('text')->label('Naam toer')->tab('Algemeen');
        CRUD::field('description')->type('textarea')->label('Omschrijving')->tab('Algemeen');
        $this->crud->addField([
            'name' => 'type_id', 
            'type' => 'select2', 
            'label' => 'Type', 
            'attribute' => 'type', 
            'model' => 'App\Models\Type',
            'tab' => 'Algemeen',
            'options' => (function ($query) {
                return $query->orderBy('type', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'name' => 'status_id', 
            'type' => 'select2', 
            'label' => 'Status', 
            'default' => '1',
            'attribute' => 'status', 
            'model' => 'App\Models\Status',
            'tab' => 'Algemeen',
            'options' => (function ($query) {
                return $query->orderBy('status', 'ASC')->get();
            }),
        ]);
        CRUD::field('start_date')->type('date')->label('Vertrekdatum')->tab('Vertrek');
        CRUD::field('start_time')->type('time')->label('Vertrektijd')->tab('Vertrek');
        $this->crud->addField([
            'name' => 'start_location_id', 
            'type' => 'select2', 
            'label' => 'Vertreklocatie', 
            'attribute' => 'name', 
            'model' => 'App\Models\Location',
            'entity' => 'start_location',
            'tab' => 'Vertrek',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::field('finish_date')->type('date')->label('Aankomstdatum')->tab('Aankomst');
        CRUD::field('finish_time')->type('time')->label('Aankomstijd')->tab('Aankomst');
        $this->crud->addField([
            'name' => 'finish_location_id', 
            'type' => 'select2', 
            'label' => 'Aankomstlocatie', 
            'attribute' => 'name', 
            'model' => 'App\Models\Location',
            'entity' => 'finish_location',
            'tab' => 'Aankomst',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        CRUD::field('distance')->type('number')->default('100')->label('Afstand')->suffix(' km')->tab('Algemeen');
        CRUD::field('routes')->entity('routes')->type('select2_multiple')->label('Route(s)')->attribute('name')->model('App\Models\Route')->pivot(true)->tab('Algemeen');
        CRUD::field('users')->entity('users')->type('select2_multiple')->label('Deelnemer(s)')->attribute('name')->model('App\Models\User')->pivot(true)->tab('Algemeen');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('id')->label('Id')->type('text');
        CRUD::column('name')->type('text')->label('Naam toer');
        CRUD::column('description')->type('textarea')->label('Omschrijving');
        CRUD::column('type_id')->type('select')->label('Type')->attribute('type')->model('App\Models\Type');
        CRUD::column('status_id')->type('select')->label('Status')->attribute('status')->model('App\Models\Status');
        CRUD::column('start_date')->type('date')->label('Vertrekdatum');
        CRUD::column('start_time')->type('time')->label('Vertrektijd');
        CRUD::column('start_location_id')->entity('start_location')->type('select')->label('Vertreklocatie')->attribute('name')->model('App\Models\Location');
        CRUD::column('finish_date')->type('date')->label('Aankomstdatum');
        CRUD::column('finish_time')->type('time')->label('Aankomstijd');
        CRUD::column('finish_location_id')->entity('finish_location')->type('select')->label('Aankomstlocatie')->attribute('name')->model('App\Models\Location');
        CRUD::column('distance')->type('number')->default('100')->label('Afstand')->suffix(' km');
        CRUD::column('routes')->entity('routes')->type('select_multiple')->label('Route(s)')->attribute('name');
        CRUD::column('users')->entity('users')->type('select_multiple')->label('Deelnemer(s)')->attribute('name');
    }

    protected function showDetailsRow($id)
    {
        $omschrijving = $this->crud->getCurrentEntry()->description;
        return '<h5>Omschrijving</h5>' . $omschrijving;
    }
}