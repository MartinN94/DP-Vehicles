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
                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <label for="price" class="font-weight-bold">Price</label>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control"  placeholder="Enter price" required value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" name="currency">
                                        <option disabled selected>Choose currency</option>
                                        <option value="eur" {{ old('currency') == 'eur' ? 'selected' : '' }}>EUR</option>
                                        <option value="usd" {{ old('currency') == 'usd' ? 'selected' : '' }}>USD</option>
                                        <option value="mkd" {{ old('currency') == 'mkd' ? 'selected' : '' }}>MKD</option>
                                      </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" name="price_type">
                                        <option disabled selected>Choose type</option>
                                        <option value="regular" {{ old('price_type') == 'regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="sale" {{ old('price_type') == 'sale' ? 'selected' : '' }}>Sale</option>
                                      </select>
                                </div>
                            </div>
                        </div>
                        <label for="status" class="font-weight-bold">Status</label>
                        <div class="row">
                            <div class="col">
                                <label for="">Sold</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="sold" {{ old('sold') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" name="sold" {{ old('sold') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                      No
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <label for="">Arriving soon</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="arriving" {{ old('arriving') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" name="arriving" {{ old('arriving') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                      No
                                    </label>
                                  </div>
                            </div>
                            <div class="col">
                                <label for="">Available</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="available" {{ old('available') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" name="available" {{ old('available') == '0' ? 'checked' : '' }}>
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
                                        <option disabled selected>Choose year</option>
                                        @foreach (App\Models\Year::all() as $item)
                                        <option value="{{ $item->id }}" {{ old('year') == $item->id ? 'selected' : '' }}>{{ $item->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="number" name="yearInput" class="form-control"  placeholder="Enter new year" value="{{ old('yearInput') }}">
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
                                        <option value="{{ $item->id }}" {{ old('maker') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="text" name="makerInput" class="form-control"  placeholder="Enter new manifacturer" value="{{ old('makerInput') }}">
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
                                        <option value="{{ $item->id }}" {{ old('model') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="text" name="modelInput" class="form-control"  placeholder="Enter new model" value="{{ old('modelInput') }}">
                                </div>
                            </div>
                        </div>
                        <label for="sku" class="font-weight-bold">SKU number</label>
                        <br>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <select class="form-control" name="sku">
                                        <option disabled selected>Choose model</option>
                                        @foreach (App\Models\Sku::all() as $item)
                                        <option value="{{ $item->id }}" {{ old('sku') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <p>OR</p>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <input type="number" name="skuInput" class="form-control"  placeholder="Enter new SKU" value="{{ old('skuInput') }}">
                                </div>
                            </div>
                        </div>
                        <label for="store" class="font-weight-bold">Store</label>
                        <br>
                        <div class="form-group">
                            <select class="form-control" name="store">
                                <option disabled selected>Choose store</option>
                                @foreach (App\Models\Store::all() as $item)
                                <option value="{{ $item->id }}" {{ old('store') == $item->id ? 'selected' : '' }}>{{ $item->name }} / {{ $item->location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <p>OR</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="storeInput" class="form-control"  placeholder="Enter new store" value="{{ old('storeInput') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="storeLocationInput" class="form-control"  placeholder="Enter new store location" value="{{ old('storeLocationInput') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Enter description" value="{{ old('description') }}" cols="30" rows="10"></textarea>
                        </div>
                        <label for="images" class="font-weight-bold">Images</label>
                        <div class="form-group">
                            <input type="file" id="file-input" name="images[]" multiple value="{{ old('images[]') }}"/> 
                        </div>
                        <div class="form-group">
                            <label for="category" class="font-weight-bold">Category</label>
                            <select class="form-control" name="category">
                                <option disabled selected>Choose category</option>
                                @foreach (App\Models\Category::all() as $item)
                                <option value="{{ $item->id }}" {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="features" class="font-weight-bold">Optional features</label>
                                    <select class="form-control features-select" multiple="true" name="feature[]">
                                        @foreach (App\Models\Optional::all() as $item)
                                        <option value="{{ $item->id }}" {{ old('feature[]') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tags" class="font-weight-bold">Tags</label>
                                    <select class="form-control tags-select" multiple="true" name="tag[]">
                                        @foreach (App\Models\Tag::all() as $item)
                                        <option value="{{ $item->id }}" {{ old('tag[]') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                    <button type="submit" class="btn btn-success">Save vehicle</button>
                    <a class="btn btn-danger" href="{{ route('profile.index') }}" role="button">Cancel</a>
                  </form>
            </div>
    </div>
</div>

@endsection