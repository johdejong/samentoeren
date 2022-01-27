<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class='la la-home nav-icon'></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('ride') }}"><i class='nav-icon la la-map-signs'></i> Toerritten</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('location') }}"><i class='nav-icon la la-map-marked'></i> Locaties</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('route') }}"><i class='nav-icon la la-route'></i> Routes</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class='nav-icon la la-user'></i> Gebruikers</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cog"></i> Beheertabellen</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('distancecategory') }}"><i class='nav-icon la la-ruler-horizontal'></i></i> Afstandscategorieën</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('country') }}"><i class='nav-icon la la-globe-europe'></i> Landen</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('status') }}"><i class='nav-icon la la-battery-half'></i> Toerstatussen</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('type') }}"><i class='nav-icon la la-stopwatch'></i> Toertypes</a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i> Backups</a></li>
