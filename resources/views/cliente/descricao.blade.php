@extends('layouts.main')

@section('title', $book->title)

@section('content')
<div class="col-md-10 offset-md-1">
    <div class="row">
      <div id="image-container" class="col-md-4">
        <img src="/imgs/books/{{$book->image}}" class="img-fluid" alt="">
      </div>
      <div id="info-container" class="col-md-8">
        <h1><strong>{{$book->title}}</strong></h1>
        <p class="book-description">{{$book->description}}</p>
        <p class="book-info"> <strong>Data de Publicação:</strong> {{$book->publication_date}}</p>
        <p class="book-info"> <strong> Autora:</strong> {{$book->autor}}</p>
        <div class="descricao-generos">
          <p class="book-info"> <strong>Género(s):</strong></p>
          <ul id="items-list" style="list-style: none">
            @foreach($book->generos as $genero)
              <li><span>{{ $genero }},</span></li>
            @endforeach
          </ul>
        </div>

        <div class="descricao-btns">

          <form action="/livros/ler/{{ $book->id }}" method="POST">
          @csrf
          <a href="/livros/ler/{{ $book->id }}" 
              class="btn btn-primary btn-lg" 
              id="book-submit"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              Ler o Livro
          </a>
         </form>
  
          @csrf
          <form action="/livros/favoritar/{{ $book->id }}" method="POST">
            @csrf
            <a href="/livros/favoritar/{{ $book->id }}" 
                class="btn btn-primary btn-lg" 
                id="book-submit"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                Adicionar aos Favoritos
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection