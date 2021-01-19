@extends('admin.dashboard')

@section('content')
<div class="wrapper">
    <div class="container">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">Categories list:</h5>
                </div>
                <div class="col-2">
                    <a href="{{ route('category.create') }}" class="btn btn-primary btn-block">Add category</a>
                </div>
            </div>
            </div>
            <table class="table">
                <tbody>
                  <tr>
                    <td>
                    <div style="width: 100%;">
                        @foreach ($categories as $category)
                        <div class="row p-5 my-5 border">
                            <div class="col-10">
                                <h5 class="card-title">Category: {{ $category->name }}</h5>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('category.edit', [$category->id]) }}" class="btn btn-warning btn-block">Edit</a>
                                <br>
                                <form action="{{ route('category.destroy', [$category->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div>{{ $categories->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection