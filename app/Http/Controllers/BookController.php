<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        $bscautor = request('bscautor');
        $bscano = request('bscano');
        $bscautorano = request('bscautorano');

        if($bscautor){
            $books = Book::where([
                ['autor', 'like', '%'.$bscautor.'%']
            ])->get();

        } 
        else if($bscano){
            $books = Book::where([
                ['publication_date', 'like', '%'.$bscano.'%']
            ])->get();
        } 
        else if($bscautorano){
            $books = Book::where([
                ['autor', 'like', '%'.$bscautorano.'%']
            ])->get();
        } 
        else {
            $books = Book::all();
        }
        return view('welcome', ['books' =>$books, 'bscautor'=>$bscautor, 'bscano'=>$bscano, 'bscautorano'=>$bscautorano]);
    }

    public function create(){
        return view ('dashboard.criar');
    }

    public function store(Request $request){
        $book = new Book;

        $book -> title = $request->title;
        $book -> publication_date = $request->publication_date;
        $book -> autor = $request->autor;
        $book -> description = $request->description;
        $book -> generos = $request->generos;
        
        if($request ->hasFile('image') ** $request->file('image')->isValid()){
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . " . " . $extension;

            $request ->image->move(public_path('imgs/books'), $imageName);

            $book ->image = $imageName;
        }

        $book -> save();

        return redirect('/') ->with('msg', 'Evento Criado com sucesso');
    }

    public function show($id){
        $book = Book::findOrFail($id);
        
        return view ('cliente.descricao', ['book' => $book]);
    }

    public function destroy($id){
        Book::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Livro eliminado com sucesso');
    }

}