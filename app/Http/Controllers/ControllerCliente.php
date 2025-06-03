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
        $nomeImagem = null;

        if ($request->hasFile('imagemUsuario') && $request->file('imagemUsuario')->isValid()) {
            $extensao = $request->file('imagemUsuario')->getClientOriginalExtension();
            $nomeImagem = time() . '_' . uniqid() . '.' . $extensao;
            $request->file('imagemUsuario')->move(public_path('img/users/fotosUsers'), $nomeImagem);
        }

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
            'img_usuario' => $nomeImagem,
            'created_at' => now()
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
        
        $usuario = Usuario::where('id', '=', $id)->first();

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
        $usuario = Usuario::find($id);


       if ($request->hasFile('imgUsuario')) { 
                // Remove foto antiga se existir
                if ($usuario->img_usuario && file_exists(public_path('img/users/fotosUsers/' . $usuario->img_usuario))) {
                    unlink(public_path('img/users/fotosUsers' . $usuario->img_usuario));
                }

                $file = $request->file('imgUsuario'); // Pega o arquivo
                $extensao = $file->getClientOriginalExtension();
                $nomeImagem = 'usuario_' . time() . '.' . $extensao;
                $file->move(public_path('img/users/fotosUsers'), $nomeImagem); // Salva
                $fotoUsuario = $nomeImagem; // Atualiza no banco
            }
        $usuario->update([
            'nome_usuario' => $request->nomeUsuario,
            'email_usuario' => $request->emailUsuario,
            'senha_usuario' =>  $request->senhaUsuario,
            'peso_usuario' => $request->pesoUsuario,
            'altura_usuario' => $request->alturaUsuario,
            'genero_usuario' => $request->generoUsuario,
            'data_nascimento_usuario' => $request->dataNascimentoUsuario,
            'hipertenso_usuario' => $request->hipertensoUsuario,
            'diabetico_usuario' => $request->diabeticoUsuario,
            'img_usuario' => $fotoUsuario,
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

    public function selectUserLogin($email){

        $usuario = Usuario::where('email_usuario','=', $email)->first();

        return response()->json([
            'Sucesso' => true,
            'dados' => $usuario,
            'code' => 200,
            'mensagem' => "dados encontrados com Sucesso!!"

        ]);



    }
}
