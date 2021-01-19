<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Digital Present | Vehicles</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('Digital Present') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">

                        @if (Route::has('login'))
                            @auth
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link">Profile</a>
                            </li>
                                @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a href="{{ route('admin') }}" class="nav-link">Dashboard</a>
                                </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                                </li>
        
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                            @endauth
                    @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script> 
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript"> 

            function addValus() {
                $("#group").change(function(){
                    var gropValue = $('#group option').filter(':selected').val();
                   
                    if (gropValue == 'details') {
                        var selectValues = {
                            "price": "Price",
                            "description": "Description",
                            "status": "Status"
                            };
                            var $mySelect = $(".subgroup");
                            $mySelect.empty();
                            $.each(selectValues, function(key, value) {
                            var $option = $("<option/>", {
                                value: key,
                                text: value
                            });
                            $mySelect.append($option);
                            });
                    }

                    if (gropValue == 'meta') {
                        var selectValues = {
                            "year": "Year",
                            "description": "Make",
                            "status": "Model",
                            "sku": "SKU",
                            };
                            var $mySelect = $(".subgroup");
                            $mySelect.empty();
                            $.each(selectValues, function(key, value) {
                            var $option = $("<option/>", {
                                value: key,
                                text: value
                            });
                            $mySelect.append($option);
                            });
                    }

                    if (gropValue == 'store') {
                        var selectValues = {
                            "name": "Name",
                            "location": "Location",
                            };
                            var $mySelect = $(".subgroup");
                            $mySelect.empty();
                            $.each(selectValues, function(key, value) {
                            var $option = $("<option/>", {
                                value: key,
                                text: value
                            });
                            $mySelect.append($option);
                            });
                    }

                    if (gropValue == 'category') {
                        var selectValues = {
                            "name": "Name",
                            };
                            var $mySelect = $(".subgroup");
                            $mySelect.empty();
                            $.each(selectValues, function(key, value) {
                            var $option = $("<option/>", {
                                value: key,
                                text: value
                            });
                            $mySelect.append($option);
                            });
                    }
                })
            }
            addValus();
        </script> 
    </body>
</html>
