@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">My vehicles list:</h5>
                </div>
                <div class="col-2">
                    <a href="{{ route('profile.create') }}" class="btn btn-primary btn-block"><i class="material-icons align-top">directions_car</i>   Add vehicle</a>
                </div>
            </div>
            </div>
            <table class="table">
                <tbody>
                  <tr>
                    <td>
                        @foreach ($vehicles as $vehicle)
                        <div style="width: 100%;">
                            <div class="row py-5 my-2 border" style="background-color: gainsboro">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ $vehicle->getFirstMediaUrl('images') }}" class="img-thumbnail rounded">
                                        </div>
                                        <div class="col-8">
                                            <h3 class="font-weight-bold">Vehicle: {{ $vehicle->maker->name }} {{ $vehicle->model->name }} - {{ $vehicle->year->year }}</h3>
                                            <h4 class="font-italic">Price: {{ $vehicle->price }} {{ $vehicle->currency }}</h4>
                                            <p>Store: {{ $vehicle->store->name }} / {{ $vehicle->store->location }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('profile.show', ['id' => $vehicle->id]) }}" class="btn btn-info btn-block">View</a>
                                    <a href="{{ route('profile.edit', ['id' => $vehicle->id]) }}" class="btn btn-warning btn-block">Edit</a>
                                    <form action="{{ route('profile.destroy', ['id' =>$vehicle->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block mt-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </td>
                  </tr>
                </tbody>
              </table>
              <div>{{ $vehicles->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection
