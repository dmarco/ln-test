@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card uper">
                <div class="card-header">
                    Edit Location
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    <form method="post" action="{{ route('location.update', $location->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
														<label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value={{ $location->name }} />
                        </div>
                        <div class="form-group">
														<label for="lat">Latitude:</label>
                            <input type="text" class="form-control" name="lat" value={{ $location->lat }} />
                        </div>
                        <div class="form-group">
														<label for="lng">Longitude:</label>
                            <input type="text" class="form-control" name="lng" value={{ $location->lng }} />
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
												<a href="{{ route('location.index')}}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>



@endsection
