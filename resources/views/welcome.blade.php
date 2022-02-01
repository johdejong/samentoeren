<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>samen toeren</title>
    </head>

    <style>
        @media only screen and (max-width: 780px) {
		.hideOnMobile{
			display: none;
		    }
	    }
    </style>

    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="{{ asset('storage/icons/logo samen toeren.svg') }}" width="50" class="img-fluid" alt="samen toeren">
                    <span class="fs-4" style="color: #f26430">samen toeren</span>
                </a>
            </header>

            <div class="row align-items-md-stretch">

                <div class="col-md-6 mb-4">
                    <div class="h-100 p-4 bg-light rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #f26430">
                        <h2 class="col-md-12 fs-3" style="color: #f26430">
                            samen toeren
                            <br><small class="text-muted">met de motor erop uit</small>
                        </h2>
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth                                
                                    <a class="btn btn-outline-primary" href="{{ url('/ride') }}" role="button">Dashboard</a> 
                                @else
                                    <a class="btn btn-outline-primary" href="{{ route('login') }}" role="button">Aanmelden</a>            
                                    @if (Route::has('register'))
                                        <a class="btn btn-outline-primary" href="{{ route('register') }}" role="button">Registreren</a>        
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-2 mb-4 hideOnMobile">
                    <div class="h-100 p-4 rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #009b72; background-color: #009b72">
                        <h2 class="fs-5 text-white">ritten</h2>
                        <p class="fs-1 text-white">{{ $rideCount ?? '' }}</p>
                    </div>
                </div>

                <div class="col-md-2 mb-4 hideOnMobile">
                    <div class="h-100 p-4 rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #009ddc; background-color: #009ddc">
                        <h2 class="fs-5 text-white">leden</h2>
                        <p class="fs-1 text-white">{{ $userCount ?? '' }}</p>
                    </div>
                </div>

                <div class="col-md-2 mb-4 hideOnMobile">
                    <div class="h-100 p-4 rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #6761a8; background-color: #6761a8">
                        <h2 class="fs-5 text-white">routes</h2>
                        <p class="fs-1 text-white">{{ $routeCount ?? '' }}</p>
                    </div>
                </div>

            </div>

            <div class="row align-items-md-stretch">

                <div class="col-md-2 mb-4 hideOnMobile">
                    <div class="h-100 p-4 rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #009b72; background-color: #009b72">
                        <h2 class="fs-3 text-white"></h2>
                        <p class="fs-1 text-white"></p>
                    </div>
                </div>

                <div class="col-md-2 mb-4 hideOnMobile">
                    <div class="h-100 p-4 rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #009ddc; background-color: #009ddc">
                        <h2 class="fs-3 text-white"></h2>
                        <p class="fs-1 text-white"></p>
                    </div>
                </div>

                <div class="col-md-2 mb-4 hideOnMobile">
                    <div class="h-100 p-4 rounded-3 text-center" style="border-style: solid; border-width: 1px; border-color: #6761a8; background-color: #6761a8">
                        <h2 class="fs-3 text-white"></h2>
                        <p class="fs-1 text-white"></p>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="h-100 p-4 bg-light rounded-3" style="border-style: solid; border-width: 1px; border-color: #f26430">
                        <h2 class="fs-3" style="color: #f26430">binnenkort of net geweest</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Datum</th>
                                    <th scope="col">Naam</th>
                                    <th scope="col">Afstand</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $lastRides as $lastRide )
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($lastRide->start_date)->formatLocalized('%A %e %B %Y')}}</td>
                                        <td>{{ $lastRide->name }}</td>
                                        <td>{{ $lastRide->distance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <footer class="pt-3 mt-4 text-muted border-top">
                &copy; samen toeren <?php echo date("Y"); ?>
            </footer>
        </div>
    </main>

</html>

