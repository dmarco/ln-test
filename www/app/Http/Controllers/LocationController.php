<?php

namespace App\Http\Controllers;

use DB;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

		/**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
				if(request()->segment(1) === 'api'){
						$this->middleware('jwt', ['except' => ['login']]);
				}
    }
		
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			
			$locations = Location::all();
			
			if(request()->segment(1) === 'api'){

				if (!$locations)
				{
					return response()->json([
						'errors' => array([
							'code' => 404,
							'message' => 'No locations found!'
						])], 404);
				}
				return response()->json([
					'status' => 'ok', 
					'data' => $locations
				], 200);

			}else{
				
				return view('location.index', compact('locations'));
			
			}

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'name'=> 'required',
        'lat'=> 'required',
        'lng' => 'required'
      ]);
      $location = new Location([
        'name' => $request->get('name'),
        'lat'=> $request->get('lat'),
        'lng'=> $request->get('lng')
      ]);
			$location->save();

			$locations = Location::all();

			if(request()->segment(1) === 'api'){

				return response()->json([
					'status' => 'ok', 
					'data' => $locations
				], 200);

			}else{
				
				return redirect('/location')->with('success', 'Location has been added');
			
			}

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
			$location = Location::find($id);
			if (!$location)
			{
				return response()->json([
					'errors' => array([
						'code' => 404,
						'message' => 'No location found!'
					])], 404);
			}
			return response()->json([
				'status' => 'ok', 
				'data' => $location
			], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $location = Location::find($id);

      return view('location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'name'=> 'required',
        'lat'=> 'required',
        'lng' => 'required'
      ]);

			$location = Location::find($id);
			
			if (!$location)
			{
				return response()->json([
					'errors' => array([
					'code' => 404,
					'message' => 'No locations found!'
				])], 404);
			}

      $location->name = $request->get('name');
      $location->lat = $request->get('lat');
      $location->lng = $request->get('lng');
			$location->save();

			if(request()->segment(1) === 'api'){

				return response()->json([
					'status' => 'ok', 
					'data' => $location
				], 200);

			}else{
				
				return redirect('/location')->with('success', 'Location has been updated');
			
			}
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$location = Location::find($id);

			if (!$location)
			{
				return response()->json([
					'errors' => array([
						'code' => 404,
						'message' => 'No locations found!'
					])], 404);
			}

			$location->delete();

			if(request()->segment(1) === 'api'){

				return response()->json([
					'status' => 'ok', 
					'data' => $location
				], 200);

			}else{
				
				return redirect('/location')->with('success', 'Location has been deleted Successfully');
			
			}
 
		}

		/**
     * Get near by locations
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function getNear($id, $limit)
    {
			$location = Location::find($id);
			$lat = $location->lat;
			$lng = $location->lng;
				
			$nearestList = DB::table("locations")
					->select("locations.id", "locations.name"
							, DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
							* cos(radians(locations.lat)) 
							* cos(radians(locations.lng) - radians(" . $lng . ")) 
							+ sin(radians(" .$lat. ")) 
							* sin(radians(locations.lat))) AS distance"))
							->where("id", "!=", $id)
							->orderBy("distance", "asc")
							->take($limit)
							->get();

			if (!$nearestList)
			{
				return response()->json([
					'errors' => array([
						'code' => 404,
						'message' => 'No locations found!'
					])], 404);
			}
			return response()->json([
				'status' => 'ok', 
				'data' => $nearestList
			], 200);

		}
		




}
