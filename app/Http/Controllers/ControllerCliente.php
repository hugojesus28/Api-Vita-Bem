<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
class ControllerCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        $usuario = Usuario::all();

        return $usuario;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeApi(Request $request)
    {
        $usuarios = Usuario::create([
            'nome_usuario' => $request->nomeUsuario,
            'email_usuario' => $request->emailUsuario,
            'senha_usuario' => $request->senhaUsuario,
            'peso_usuario' => $request->pesoUsuario,
            'altura_usuario' => $request->alturaUsuario,
            'genero_usuario' => $request->generoUsuario,
            'data_nascimento_usuario' => $request->dataNascimentoUsuario,
            'hipertenso_usuario' => $request->hipertensoUsuario,
            'diabetico_usuario' => $request->diabeticoUsuario,
            'img_usuario' => $request->imgUsuario,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'mensagem' => 'Usuario Cadastrado com Sucesso!',
            'code' => 200,
            'usuarios' => $usuarios,
            'request' => $request->nomeUsuario
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showApi($id)
    {
        
        $usuario = Usuario::all()->where('id', $id);

        return response()->json([
            'mensagem' => 'usuario cadastrado',
            'code' => 200,
            'usuario' => $usuario
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApi(Request $request, $id)
    {
        $usuario = Usuario::where('id', $id)->update([
            'nome_usuario' => $request->nomeUsuario,
            'email_usuario' => $request->emailUsuario,
            'senha_usuario' =>  $request->senhaUsuario,
            'peso_usuario' => $request->pesoUsuario,
            'altura_usuario' => $request->alturaUsuario,
            'genero_usuario' => $request->generoUsuario,
            'data_nascimento_usuario' => $request->dataNascimentoUsuario,
            'hipertenso_usuario' => $request->hipertensoUsuario,
            'diabetico_usuario' => $request->diabeticoUsuario,
            'img_usuario' => $request->imgUsuario,
            'updated_at' => now()
        ]); 

        return response()->json([
            'message' => 'Cliente atualizado com sucesso',
            'code' => 200,
            'usuario' => $usuario
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyApi($id)
    {
        Usuario::where('id', $id)->delete();

        return response()->json([
            'message' => 'dados excluidos',
            'code' => 200
        ]);
    }
}
