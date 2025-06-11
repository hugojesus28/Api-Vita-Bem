<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pressao;
class PressaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $nomeImagem = null;
        
         if ($request->hasFile('imgPressao') && $request->file('imgPressao')->isValid()) {
            $extensao = $request->file('imgPressao')->getClientOriginalExtension();
            $nomeImagem = time() . '_' . uniqid() . '.' . $extensao;
            $request->file('imgPressao')->move(public_path('img/users/fotosPressao'), $nomeImagem);
        }

        $pressao = Pressao::create([
            'id_usuario' => $request->idUsuario,
            'data_pressao' => now()->format('Y-m-d'),
            'hora_pressao' => now()->format('H:i:s'),
            'medida_pressao' => $request->medidaPressao,
            'observacao' => $request->observacao,
            'img_pressao' => $nomeImagem,
        ]);

        return response()->json([
            'messagem' => 'Pressao feita',
            'pressao' => $pressao,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pressao = Pressao::where('id_usuario', $id)->get();

        if ($pressao->isEmpty()) {
            return response()->json(['message' => 'Nenhum dado de pressão encontrado para o usuário'], 404);
        }

        return response()->json(['pressao' => $pressao,'code' => 200]);
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
    public function update(Request $request, $id)
    {
        $pressao = Pressao::find($id);
        if(!$pressao){
            return response()->json(['message' => 'Pressão não encontrada'], 404);
        }

        $fotoPressao = $request->imgPressao ?? $pressao->img_pressao;
        if ($request->hasFile('imgPressao') && $request->file('imgPressao')->isValid() && $request->imgPressao != $pressao->imgPressao) {
            if ($pressao->img_pressao && file_exists(public_path('img/users/fotosPressao/' . $pressao->img_pressao))) {
                unlink(public_path('img/users/fotosPressao/' . $pressao->img_pressao));
            }
            $extensao = $request->file('imgPressao')->getClientOriginalExtension();
            $nomeImagem = time() . '_' . uniqid() . '.' . $extensao;
            $request->file('imgPressao')->move(public_path('img/users/fotosPressao'), $nomeImagem);
            $fotoPressao = $nomeImagem;
        }

        $pressao->update([
            'id_usuario' => $request->idUsuario,
            'data_pressao' => now()->format('Y-m-d'),
            'hora_pressao' => now()->format('H:i:s'),
            'medida_pressao' => $request->medidaPressao,
            'observacao' => $request->observacao,
            'img_pressao' => $fotoPressao,
        ]);
        return response()->json([
            'message' => 'Pressão atualizada com sucesso',
            'pressao' => $pressao
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pressao = Pressao::find($id);
        if(!$pressao){
            return response()->json(['message' => 'Pressão não encontrada'], 404);
        }
        $pressao->delete();
        return response()->json(['message' => 'Pressão deletada com sucesso'], 200);
    }
}
