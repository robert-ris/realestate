<?php

namespace App\Http\Controllers;

use App\Properties;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('properties.create')->with('success', 'Property Successfuly Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'price' => 'required',
            'cover_image' => 'required|image|max:1999',
        ]);

        $cover_image = $request->file('cover_image');
        $slug = str_slug($request->name);

        if(isset($cover_image)){
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $cover_imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $cover_image->getClientOriginalExtension();
//            check category dir if exist
            if(!Storage::disk('public')->exists('cover_image')){
                Storage::disk('public')->makeDirectory('cover_image');
            }
//            resize image and upload
            $cover_imageToUpload = Image::make($cover_image)->resize(800, 600);
            Storage::disk('public')->put('cover_image/' . $cover_imageName, $cover_imageToUpload);
        }else{
            $cover_imageName = 'default.png';
        }

        $property = new Properties();
        $property->title = $request->title;
        $property->description = $request->description;
        $property->address = $request->address;
        $property->city = $request->city;
        $property->region = $request->region;
        $property->country = $request->country;
        $property->lat = $request->lat;
        $property->long = $request->long;
        $property->price = $request->price;
        $property->cover_image = $cover_imageName;
        $property->save();
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Properties::find($id);
        return view('properties.show')->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Properties::find($id);
        return view('properties.edit')->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'price' => 'required',
            'cover_image' => 'required|image|max:1999',
        ]);

        $cover_image = $request->file('cover_image');
        $property = Properties::find($id);

        if(isset($cover_image)){
//            make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $cover_imageName = $currentDate . '-' . uniqid() . '.' . $cover_image->getClientOriginalExtension();
//            check category dir if exist
            if(!Storage::disk('public')->exists('cover_image')){
                Storage::disk('public')->makeDirectory('cover_image');
            }
//            delete old image
            if (Storage::disk('public')->exists('cover_image/' . $property->cover_image)){
                Storage::disk('public')->delete('cover-image/' . $property->cover_image);
            }
//            resize image and upload
            $cover_imageToUpload = Image::make($cover_image)->resize(800, 600);
            Storage::disk('public')->put('cover_image/' . $cover_imageName, $cover_imageToUpload);
        }else{
            $cover_imageName = 'default.png';
        }

        $property->title = $request->title;
        $property->description = $request->description;
        $property->address = $request->address;
        $property->city = $request->city;
        $property->region = $request->region;
        $property->country = $request->country;
        $property->lat = $request->lat;
        $property->long = $request->long;
        $property->price = $request->price;
        $property->cover_image = $cover_imageName;
        $property->save();
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Properties::find($id);
        if(Storage::disk('public')->exists('cover_image' . $property->cover_image)){
            Storage::disk('public')->delete('cover_image' . $property->cover_image);
        }
        $property->delete;
        return redirect()->back();

    }
}
