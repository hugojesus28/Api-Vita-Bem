<?php

namespace App\Http\Controllers;

use App\Models\Diabete;
use Illuminate\Http\Request;

class DiabeteController extends Controller
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

        if ($request->hasFile('imgGlicemia') && $request->file('imgGlicemia')->isValid()) {
            $extensao = $request->file('imgGlicemia')->getClientOriginalExtension();
            $nomeImagem = time() . '_' . uniqid() . '.' . $extensao;
            $request->file('imgGlicemia')->move(public_path('img/users/fotosGlicose'), $nomeImagem);
        }
        $diabete = Diabete::create([
            'id_usuario' => $request->idUsuario,
            'data_registro' => now()->format('Y-m-d'),
            'horario_registro' => now()->format('H:i:s'),
            'nivel_glicose' => $request->nivelGlicose,
            'observacao' => $request->observacao,
            'img_glicose' => $nomeImagem,

        ]);

        return response()->json([
            'message' => 'Diabete registered successfully',
            'diabete' => $diabete,
            'code' => 201
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
        $diabete = Diabete::where('id_usuario', $id)->get();
        if ($diabete) {
            return response()->json(['diabete' => $diabete,'code'=> 200]);
        } else {
            return response()->json(['message' => 'Diabete not found'], 404);
        }
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
        $diabete = Diabete::find($id);
        $imgGlicemia = $request->imgGlicemia ?? $diabete->img_glicose; 
       if ($request->hasFile('imgGlicemia') && $request->imgGlicemia != $diabete->img_glicose) { 
    
                if ($diabete->img_glicose && file_exists(public_path('img/users/fotosGlicose/' . $diabete->img_glicose))) {
                    unlink(public_path('img/users/fotosGlicose/' . $diabete->img_glicose));
                }

                $file = $request->file('imgGlicemia'); 
                $extensao = $file->getClientOriginalExtension();
                $nomeImagem = 'imgGlicemia' . time() . '.' . $extensao;
                $file->move(public_path('img/users/fotosGlicose'), $nomeImagem); 
                $imgGlicemia = $nomeImagem; 
            }
        if (!$diabete) {
            return response()->json(['message' => 'Diabete not found'], 404);
        }
        $diabete->update([
            'data_registro' => now()->format('Y-m-d'),
            'nivel_glicose' => $request->nivelGlicose,
            'observacao' => $request->observacao,
            'id_usuario' => $request->idUsuario,
            'updated_at' => now(),
            'horario_registro' => now()->format('H:i:s'),
            'img_glicose' => $imgGlicemia,

        ]);

        return response()->json(['message' => 'Diabete updated successfully', 'diabete' => $diabete, 'code' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diabete = Diabete::find($id);
        if ($diabete) {
            $diabete->delete();
            return response()->json(['message' => 'Diabete deletado Com sucesso', 'code' => 200]);
        } else {
            return response()->json(['message' => 'Diabete not found'], 404);
        }
    }
}
