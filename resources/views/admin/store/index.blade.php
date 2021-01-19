@extends('admin.dashboard')

@section('content')
<div class="wrapper">
    <div class="container">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">Stores list:</h5>
                </div>
                <div class="col-2">
                    <a href="{{ route('store.create') }}" class="btn btn-primary btn-block">Add Store</a>
                </div>
            </div>
            </div>
            <table class="table">
                <tbody>
                  <tr>
                    <td>
                    <div style="width: 100%;">
                        @foreach ($stores as $store)
                        <div class="row p-5 my-5 border">
                            <div class="col-10">
                                <h5 class="card-title">Store: {{ $store->name }}</h5>
                                <p class="card-text">Location: {{ $store->location }}</p>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('store.edit', [$store->id]) }}" class="btn btn-warning btn-block">Edit</a>
                                <br>
                                <form action="{{ route('store.destroy', [$store->id]) }}" method="POST">
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
              <div>{{ $stores->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection