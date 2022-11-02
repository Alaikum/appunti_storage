@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Crea il post:</h1>
            </div>
        </div>
    </div>

    <div class="container">
     
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <p>
                        <label for="cover">
                            cover
                        </label>
                        <input type="file" class="" name="cover" id="cover" >
                        <label for="cover">Scegli immagine</label>
                    </p>
                    <p>
                        <label for="title">titolo</label>
                        <input type="text" name='title' id='title'
                            placeholder="titolo">
                    </p>
                    <p>
                        <label for="content">Contenuto</label>
                        <input type="text" name='content' id='content'
                            placeholder="Testo">
                    </p>
                    <label for="category">Categoria</label>
                    <select name="category_id" id="" required>
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