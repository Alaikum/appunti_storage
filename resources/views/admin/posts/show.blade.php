@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dettaglio del post:</h1>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <img src="{{$post->cover_path}}" alt="">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->slug }}</p>
                <p>{{ $post->created_at }}</p>
                <p>{{ $post->updated_at }}</p>

                Categoria:
                @if ($post->category)
                    <p>{{ $post->category->name }}</p>
                @endif

                {{-- <p>@dump($post->category())</p> --}}
                <a href="{{ route('admin.posts.edit', $post) }}">Modifica</a>
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Elimina">
                </form>


                altri post stessa categoria :
                @if ($post->category)
                    @foreach ($post->category->posts as $relatedPost)
                        <p>{{ $relatedPost->title }}</p>
                    @endforeach
                @endif


            </div>
        </div>
    </div>
@endsection
