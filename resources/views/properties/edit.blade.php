@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-2 col-md-0"></div>
            <div class="col-lg-8 col-md-12">
                <div class="post-wrapper">
                    <h2>Edit Property</h2>
                    <hr>
                    <div class="body">
                        <form action="{{ route('posts.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name="title" value="{{ $property->title }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" id="city" class="form-control" name="city" value="{{ $property->city }}">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="country" class="form-control" name="country" value="{{$property->country}}">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="region" class="form-control" name="region" value="{{ $property->region }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="address" class="form-control" name="address" value="{{ $property->address }}"}}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="number" id="lat" class="form-control" name="lat" step="any" value="{{ $property->lat }}">
                                        </div>
                                        <div class="col">
                                            <input type="number" id="long" class="form-control" name="long" step="any" value="{{ $property->long }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="price" class="form-control" name="price" step="any" value="{{ $property->price }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="description" class="form-control" name="description">{{ $property->description }}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="file" name="cover_image">
                                </div>
                                <hr>
                                <a class="btn btn-danger" href="#">BACK</a>
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection