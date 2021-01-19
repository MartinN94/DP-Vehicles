@extends('admin.dashboard')
@section('content')
<div class="wrapper">
    <div class="container" style="width: 50%">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">Edit model:</h5>
                </div>
            </div>
            </div>
            <div class="p-3">
                <form action="{{ route('model.update', [$model->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <input type="text" name="name" class="form-control"  placeholder="Enter model" value="{{ $model->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                  </form>
            </div>
    </div>
</div>
@endsection