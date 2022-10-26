@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Modifica il post:{{$post->title}}</h1>
            </div>
        </div>
    </div>

    <div class="container">
     
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.posts.update',$post) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <p>
                        <label for="title">titolo</label>
                        <input type="text" name='title' id='title' value="{{old('title',$post->title)}}"
                            placeholder="titolo">
                    </p>
                    <p>
                        <label for="content">Contenuto</label>
                        <input type="text" name='content' id='content' value="{{old('content',$post->content)}}"
                            placeholder="Testo">
                    </p>
                    <label for="category">Categoria</label>
                    <select name="category_id" id="" required value="{{old('category',$post->category)}}">
                        <option value=" ">--nessuna--</option>
                      @foreach ($categories as $category)
                          
                      <option @if(old('cateory_id')===$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                
                    </select>

                    <p>
                        <input type="submit" value="salva">
                    </p>
             </form>
          
            </div>
        </div>
    </div>

     {{-- STAMPA L'ERRORE  --}}
     @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
@endsection