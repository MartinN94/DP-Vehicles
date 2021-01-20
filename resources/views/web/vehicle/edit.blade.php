@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container" style="width: 50%">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">New vehicle:</h5>
                </div>
            </div>
            </div>
            <div class="p-3 border">
                <form action="{{ route('profile.update', ['id'=> $vehicle->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="price" class="font-weight-bold">Price</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control"  placeholder="Enter price" required value="{{ $vehicle->price }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" name="currency">
                                        <option {{ $vehicle->currency == 'eur' ? 'selected' : '' }} value="eur">EUR</option>
                                        <option {{ $vehicle->currency == 'usd' ? 'selected' : '' }} value="usd">USD</option>
                                        <option {{ $vehicle->currency == 'mkd' ? 'selected' : '' }} value="mkd">MKD</option>
                                      </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" name="price_type">
                                        <option {{ $vehicle->price_type == 'regular' ? 'selected' : '' }} value="regular">Regular</option>
                                        <option {{ $vehicle->price_type == 'sale' ? 'selected' : '' }} value="sale">Sale</option>
                                      </select>
                                </div>
                            </div>
                        </div>
                        <label for="status" class="font-weight-bold">Status</label>
                        <div class="row">
                            <div class="col">
                                <label for="">Sold</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="sold" {{  ($vehicle->sold == 1 ? ' checked' : '') }}>
                                    <label class="form-check-label">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" name="sold" {{  ($vehicle->sold == 0 ? ' checked' : '') }}>
                                    <label class="form-check-label">
                                      No
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <label for="">Arriving soon</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="arriving" {{  ($vehicle->arriving == 1 ? ' checked' : '') }}>
                                    <label class="form-check-label">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" name="arriving" {{  ($vehicle->arriving == 0 ? ' checked' : '') }}>
                                    <label class="form-check-label">
                                      No
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <label for="">Available</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="available" {{  ($vehicle->available == 1 ? ' checked' : '') }}>
                                    <label class="form-check-label">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" name="available" {{  ($vehicle->available == 0 ? ' checked' : '') }}>
                                    <label class="form-check-label">
                                      No
                                    </label>
                                  </div>
                            </div>
                        </div>
                        <br>
                        <label for="meta" class="font-weight-bold">Year</label>
                        <br>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control" name="year">
                                        @foreach (App\Models\Year::all() as $item)
                                        <option value="{{ $item->id }}" {{ $vehicle->year->id == $item->id  ? 'selected' : '' }}>{{ $item->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="number" name="yearInput" class="form-control"  placeholder="Enter new year">
                                </div>
                            </div>
                        </div>
                        <label for="maker" class="font-weight-bold">Maker</label>
                        <br>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control" name="maker">
                                        <option disabled selected>Choose manifacturer</option>
                                        @foreach (App\Models\Make::all() as $item)
                                        <option value="{{ $item->id }}" {{ $vehicle->maker->id === $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="text" name="makerInput" class="form-control"  placeholder="Enter new manifacturer">
                                </div>
                            </div>
                        </div>
                        <label for="model" class="font-weight-bold">Model</label>
                        <br>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control" name="model">
                                        <option disabled selected>Choose model</option>
                                        @foreach (App\Models\Type::all() as $item)
                                        <option value="{{ $item->id }}" {{ $vehicle->model->id === $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="text" name="modelInput" class="form-control"  placeholder="Enter new model">
                                </div>
                            </div>
                        </div>
                        <label for="sku" class="font-weight-bold">SKU number</label>
                        <br>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control" name="sku">
                                        <option disabled selected>Choose SKU</option>
                                        @foreach (App\Models\Sku::all() as $item)
                                        <option value="{{ $item->id }}" {{ $vehicle->sku->id === $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="number" name="skuInput" class="form-control"  placeholder="Enter new SKU">
                                </div>
                            </div>
                        </div>
                        <label for="store" class="font-weight-bold">Store</label>
                        <br>
                        <div class="form-group">
                            <select class="form-control" name="store">
                                <option disabled selected>Choose store</option>
                                @foreach (App\Models\Store::all() as $item)
                                <option value="{{ $item->id }}" {{ $vehicle->store->id === $item->id  ? 'selected' : '' }}>{{ $item->name }} / {{ $item->location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <p>OR</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="storeInput" class="form-control"  placeholder="Enter new store">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="storeLocationInput" class="form-control"  placeholder="Enter new store location">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Enter description" cols="30" rows="10">{{ $vehicle->description }}</textarea>
                        </div>
                        <label for="images" class="font-weight-bold">Images</label>
                        <div class="form-group">
                            <input type="file" id="file-input" name="images[]" multiple value="{{ $vehicle->getMedia('images') }}"/> 
                        </div>
                        <div class="form-group">
                            <label for="category" class="font-weight-bold">Category</label>
                            <select class="form-control" name="category">
                                <option disabled selected>Choose category</option>
                                @foreach (App\Models\Category::all() as $item)
                                <option value="{{ $item->id }}" {{ $vehicle->category->id === $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="features" class="font-weight-bold">Optional features</label>
                                    <select class="form-control features-select" multiple="true" name="feature[]">
                                        @foreach (App\Models\Optional::all() as $item)
                                        @foreach ($vehicle->features as $feature)
                                        <option value="{{ $item->id }}" {{$feature->id === $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tags" class="font-weight-bold">Tags</label>
                                    <select class="form-control tags-select" multiple="true" name="tag[]">
                                        @foreach (App\Models\Tag::all() as $item)
                                        @foreach ($vehicle->tags as $tag)
                                        <option value="{{ $item->id }}" {{$tag->id === $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                    <button type="submit" class="btn btn-success">Save vehicle</button>
                    <a class="btn btn-danger" href="{{ route('vehicle.index') }}" role="button">Cancel</a>
                  </form>
            </div>
    </div>
</div>
@endsection
