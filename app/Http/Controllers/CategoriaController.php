<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;



class CategoriaController extends Controller{
    public function adicionar(Request $request){
        if($request->has('nome_categoria')){
            $nome_categoria = $request->input('nome_categoria');
            $categorias = new Categoria;
            $categorias->nome_categoria = $nome_categoria;
            $categorias->save();
            return redirect('/home');
        }
        return view('categoria');
    }
}