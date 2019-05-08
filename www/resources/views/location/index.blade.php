@extends('layouts.app')

@section('content')

<div class="container">

		<div class="row justify-content-center">
        <div class="col-md-12">
						<div id="map"></div>
				</div>
		</div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="uper">
                @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div><br />
                @endif
								<a href="{{ route('location.create')}}" class="btn btn-success">Add Location</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Latitude</td>
                            <td>Longitude</td>
                            <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                        <tr>
                            <td>{{$location->id}}</td>
                            <td>{{$location->name}}</td>
                            <td>{{$location->lat}}</td>
                            <td>{{$location->lng}}</td>
                            <td><a href="{{ route('location.edit',$location->id)}}" class="btn btn-primary">Edit</a></td>
                            <td>
                                <form action="{{ route('location.destroy', $location->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
						<div>
				</div>
		</div>
</div>
@endsection

@push('scripts')
<script>

	$(document).ready(function(){

		var locations = {!! $locations !!};
	
		var map = L.map('map').setView([51.505, -0.09], 12);

		L.tileLayer( 'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}.png', {
				attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>',
				crossOrigin: true
		}).addTo( map );

		var arrayOfLatLngs = [];
		var n = 0;
		locations.forEach(function(loc) {
			arrayOfLatLngs[n] = [loc.lat, loc.lng];
			n++;
			L.marker([loc.lat, loc.lng]).addTo(map).bindPopup(`${loc.name}`);
		});

		var popup = L.popup();

		var bounds = new L.LatLngBounds(arrayOfLatLngs);
		map.fitBounds(bounds);

	});

</script>
@endpush
