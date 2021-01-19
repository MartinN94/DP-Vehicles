@extends('layouts.site')

@section('content')
<div class="wrapper">
    <div class="container mt-4">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">Vehicle details:</h5>
                </div>
                <div class="col-2">
                    <a href="{{ route('index') }}" class="btn btn-secondary btn-block">Back</a>
                </div>
            </div>
            </div>
            <table class="table">
                <tbody>
                  <tr>
                    <td>
                        <div style="width: 100%;">
                            <div class=" py-3 border" style="background-color: gainsboro">
                                    <div class="px-4">
										<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
											<div class="carousel-inner">
												@foreach ($vehicle->getMedia('images') as $image)
												<div class="carousel-item {{ $loop->first ? 'active' : '' }}">
													<img class="d-block img-fluid" style="width: 100%; height:55vh" src="{{ $image->getUrl() }}">
												</div>
												@endforeach
											</div>
											<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
											  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
											  <span class="sr-only">Previous</span>
											</a>
											<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
											  <span class="carousel-control-next-icon" aria-hidden="true"></span>
											  <span class="sr-only">Next</span>
											</a>
										  </div>
									</div>
                                    <div class="px-5 my-4">
										<div class="row text-center">
											<div class="col">
												<h3 class="font-italic">Vehicle: {{ $vehicle->maker->name }}</h3>
											</div>
											<div class="col">
												<h4 class="font-italic">Model: {{ $vehicle->model->name }} </h4>
											</div>
											<div class="col">
												<h4>Production year:  {{ $vehicle->year->year }}</h4>
											</div>
										</div>
										<div class="text-center my-4">
											<h4 class="font-italic text-danger">Price: {{ $vehicle->price }} {{ $vehicle->currency }} , type: {{ $vehicle->price_type }}</h4>
											<p>Store: {{ $vehicle->store->name }} / {{ $vehicle->store->location }}</p>
											<h5>SKU: {{ $vehicle->sku->name }}</h5>
										</div>
										<div class="row my-4 text-center">
											<div class="col">
											<h4>Sold: {{ ($vehicle->sold == '0') ? 'NO':'YES'  }}</h4>
											</div>
											<div class="col">
												<h4>Arriving: {{ ($vehicle->arriving == '0') ? 'NO':'YES'  }}</h4>
											</div>
											<div class="col">
												<h4>Available: {{ ($vehicle->available == '0') ? 'NO':'YES'  }}</h4>
											</div>
										</div>
										<div class="bg-light p-4">
											<div>
												<p class="font-weight-bold">Description</p>
												{{ $vehicle->description }}
											</div>
											<div class="my-4">
												<p>Optional features:</p>
												<ul>
												@foreach ($vehicle->features as $feature)
												<li>{{ $feature->name }}</li>
												@endforeach
											</ul>
											</div>
											<div>
												@foreach ($vehicle->tags as $tag)
													<small class="text-primary">#{{ $tag->name }}</small>
												@endforeach
											</div>
										</div>
                                </div>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
    </div>
</div>
@endsection