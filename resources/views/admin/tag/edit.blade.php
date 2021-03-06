@extends('admin.dashboard')
@section('content')
<div class="wrapper">
    <div class="container" style="width: 50%">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">Edit tag:</h5>
                </div>
            </div>
            </div>
            <div class="p-3">
                <form action="{{ route('tag.update', [$tag->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <input type="text" name="tag" class="form-control"  placeholder="Enter category" value="{{ $tag->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                  </form>
            </div>
    </div>
</div>
@endsection