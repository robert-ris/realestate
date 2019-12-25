@extends('layouts.app')

@section('content')
  <div class="container">
    <a href="/" class="btn btn-default">Go Back</a>
    <h1>{{$property->title}}</h1>
    <img src="/storage/cover_images/{{$property->cover_image}}" alt="image">
    <br><br>
      <div>{{$property->description}}</div>
      <div>{{$property->address}}</div>
      <div>{{$property->city}}</div>
      <div>{{$property->region}}</div>
      <div>{{$property->country}}</div>
      <div>{{$property->price}}</div>
    <hr>



              <td><a href="/posts/{{$property->id}}/edit" class="btn btn-default">Edit</a></td>
              <td>
                  <form action="{{ route('posts.destroy', $property->id) }}", method="POST", class="pull-right">
                      <input type="hidden" method="DELETE">
                      <input type="submit" class="btn btn-danger" value="DELETE">
                  </form>
              </td>

  </div>
@endsection