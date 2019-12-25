@extends('layouts.app')

@push('css')
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    <header class="main-header">
        <h1><span>Real</span> Estate</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem,
            consectetur.
        </p>
    </header>

    <main class="container">
        @foreach($properties as $property)
        <section class="card">
            <img src="/storage/cover_images/{{ $property->cover_image }}" alt="" />
            <div>
                <h3>{{ $property->title }}</h3>
                <p>{{ $property->country }}</p>
                <p>{{ $property->city }}</p>
                <p>$ {{ $property->price }}</p>
                <a href="{{ route('posts.show', $property->id) }}" class="btn">More Info</a>
            </div>
        </section>
        @endforeach
            {{$properties->links()}}
    </main>

@endsection

@push('js')

@endpush
