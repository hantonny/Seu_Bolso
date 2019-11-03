<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transacao;
use App\User;
use App\Categoria;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $lista = Transacao::All();
        $array = array('lista'=>$lista);
        $usuarios = User::All();
        $array2 = array('user'=>$usuarios);
        return view('home', $array, $array2);  
    }

    public function adicionar(Request $request){
        $usuarios = User::All();
        $categoria = Categoria::All();
        $categorias = array('categoria'=> $categoria);
        $array2 = array('user' => $usuarios);
        if($request->has('tipo')){
            $tipo = $request->input('tipo');
            $valor = $request->input('valor');
            $data_transacao = $request->input('data_transacao');
            $descricao = $request->input('descricao');
            $usuarios = $request->input('user');
            $categoriainput = $request->input('nome_categoria');
            $lista = new Transacao;
            $lista->tipo = $tipo;
            $lista->valor = $valor;
            $lista->data_transacao = $data_transacao;
            $lista->descricao = $descricao;
            $lista->id_user = $usuarios;
            $lista->nome_categoria = $categoriainput;
            $lista->save();
            return redirect('/home');
        }
        
        return view('adicionar', $array2, $categorias);
    }
    public function deletar($id){
        Transacao::find($id)->delete();
        return redirect('/home');
    }
    public function alterar($id,Request $request){
        $categoria = Categoria::All();
        $categorias = array('categoria'=> $categoria);
        if($request->has('tipo')){  
            $transacao = Transacao::find($id);
            $transacao->tipo = $request->input('tipo');
            $transacao->valor = $request->input('valor');
            $transacao->data_transacao = $request->input('data_transacao');
            $transacao->descricao = $request->input('descricao');
            $transacao->nome_categoria = $request->input('nome_categoria');
            $transacao->save();
            return redirect('/home');
        }
        $resultado = Transacao::find($id);
        $array = array('resultado'=>$resultado);
        return view('alterar',$array,$categorias);
    }
    public function gerarPDF(){
        $lista = Transacao::All();
        $array = array('lista'=>$lista);
        $usuarios = User::All();
        $array2 = array('usuarios'=>$usuarios);
        $categoria = Categoria::All();
        $categorias = array('categoria'=>$categoria);
 
    return \PDF::loadView('gerarpdf', compact('lista', 'usuarios'))->stream();
    }
    public function graficoGerar(){
        $lista = Transacao::All();
        $array = array('lista'=>$lista);
        $usuarios = User::All();
        $array2 = array('user'=>$usuarios);
        $categoria = Categoria::All();
        $categorias = array('categoria'=>$categoria);
        return view('grafico', compact('lista', 'usuarios', 'categoria')); 
        
    }
}

