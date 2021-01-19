@extends('admin.dashboard')

@section('content')
<div class="wrapper">
    <div class="container">
            <div class=" bg-dark border-b border-gray-200">
             <div class="row p-3">
                <div class="col-10">
                    <h5 class="card-title text-light">Maker list:</h5>
                </div>
                <div class="col-2">
                    <a href="{{ route('make.create') }}" class="btn btn-primary btn-block">Add maker</a>
                </div>
            </div>
            </div>
            <table class="table">
                <tbody>
                  <tr>
                    <td>
                    <div style="width: 100%;">
                        @foreach ($makers as $make)
                        <div class="row p-5 my-5 border">
                            <div class="col-10">
                                <h5 class="card-title">Maker: {{ $make->name }}</h5>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('make.edit', [$make->id]) }}" class="btn btn-warning btn-block">Edit</a>
                                <br>
                                <form action="{{ route('make.destroy', [$make->id]) }}" method="POST">
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
              <div>{{ $makers->links('pagination::bootstrap-4') }}</div>
    </div>
</div>
@endsection