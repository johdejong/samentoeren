@extends(backpack_view('blank'))

@section('content')

<div class="row">

  <div class="col-sm-3">
    <div class="card" style="border-color:#009ddc">
      <div class="card-header text-white" style="background-color:#009ddc">
        <h5>Gebruikers</h5>
      </div>
      <div class="card-body">
        <h3 class="card-title text-center">{{ $userCount ?? '' }}</h3>
      </div>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="card" style="border-color:#f26430">
      <div class="card-header text-white" style="background-color:#f26430">
        <h5>Locaties</h5>
      </div>
      <div class="card-body">
        <h3 class="card-title text-center">{{ $locationCount ?? '' }}</h3>
      </div>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="card" style="border-color:#6761a8">
      <div class="card-header text-white" style="background-color:#6761a8">
        <h5>Routes</h5>
      </div>
      <div class="card-body">
        <h3 class="card-title text-center">{{ $routeCount ?? '' }}</h3>
      </div>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="card" style="border-color:#009b72">
      <div class="card-header text-white" style="background-color:#009b72">
        <h5>Toerritten</h5>
      </div>
      <div class="card-body">
        <h3 class="card-title text-center">{{ $rideCount ?? '' }}</h3>
      </div>
    </div>
  </div>

  <div class="col-sm-12">
    <div class="card" style="border-color:#6761a8">
      <div class="card-header text-white" style="background-color:#6761a8">
        <h5>Gebruikersacties</h5>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Datum</th>
              <th scope="col">Naam</th>
              <th scope="col">Bericht</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usersActions as $userAction)
              <tr>
                <td>{{ \Carbon\Carbon::parse($userAction->created_at)->translatedFormat('j F Y H:i:s')}}</td>
                <td>{{ $userAction->name }}</td>
                <td>{{ $userAction->message }}</td>
              </tr>
            @endforeach            
          </tbody>
        </table>
        {{ $usersActions->links() }}        
      </div>
    </div>
  </div>

</div>

@endsection