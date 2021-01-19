<div class="container-fluid">
    <div class="row">
        <div class="col-2 px-1 bg-secondary position-fixed" id="sticky-sidebar" style="height: 100%">
                <div class="list-group bg-dark">
                    <a href="{{ route('vehicle.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">directions_car</i>   Vehicles</a>
                    <a href="{{ route('year.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">layers</i>   Years</a>
                    <a href="{{ route('make.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">work</i>   Makes</a>
                    <a href="{{ route('model.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">toll</i>   Models</a>
                    <a href="{{ route('sku.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">subject</i>   SKUs</a>
                    <a href="{{ route('store.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">room</i>   Stores</a>
                    <a href="{{ route('optional.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">tune</i>   Optional features</a>
                    <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">view_list</i>   Categories</a>
                    <a href="{{ route('tag.index') }}" class="list-group-item list-group-item-action bg-secondary text-light px-3"> <i class="material-icons align-top">view_headline</i>   Tags</a>
                </div>
        </div>
        <div class="col-10 offset-2 py-2" id="main">
            @include('admin.includes.alert')
            @yield('content')

            @auth
                @if (request()->is('admin'))
                    <div class="container m-auto">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                            <h1 class="display-4">Hello, {{ Auth::user()->name }}</h1>
                            <p class="lead">Click on the left menues to edit content!</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>