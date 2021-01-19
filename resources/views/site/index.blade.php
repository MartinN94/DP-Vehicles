@extends('layouts.site')

@section('content')

<div class="wrapper">
    <div class="container">
            <div class=" bg-dark border-b border-gray-200 my-4">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">My vehicles list:</h5>
                </div>
                <div class="col-2">
                </div>
            </div>
            </div>
            <table class="table">
                <tbody>
                  <tr>
                    <td>
                        @foreach ($vehicles as $vehicle)
                        <a href="{{ url('/view', $vehicle->id) }}" style="text-decoration: none; color:black;">
                        <div style="width: 100%;">
                            <div class="row py-5 my-2 border" style="background-color: gainsboro">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ $vehicle->getFirstMediaUrl('images') }}" class="img-thumbnail rounded">
                                        </div>
                                        <div class="col-8 px-5">
                                            <h3 class="font-weight-bold">Vehicle: {{ $vehicle->maker->name }} {{ $vehicle->model->name }} - {{ $vehicle->year->year }}</h3>
                                            <h4 class="font-italic">Price: {{ $vehicle->price }} {{ $vehicle->currency }}</h4>
                                            <p>Store: {{ $vehicle->store->name }} / {{ $vehicle->store->location }}</p>
                                            <div class="border-primary border-top my-3"></div>
                                            <h4>Status:</h4>
                                            <div class="row">
                                                <div class="col">
                                                    <p>Arriving: {{ ($vehicle->arriving == '0') ? 'NO':'YES'  }}</p>
                                                </div>
                                                <div class="col">
                                                    <p>Sold: {{ ($vehicle->sold == '0') ? 'NO':'YES'  }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    </td>
                  </tr>
                </tbody>
              </table>
              <div>{{ $vehicles->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection

