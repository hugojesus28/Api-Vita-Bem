<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\remedio;

class RemedioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remedio = remedio::all();

        return $remedio;
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

        if ($request->hasFile('imagemRemedio') && $request->file('imagemRemedio')->isValid()) {
            $extensao = $request->file('imagemRemedio')->getClientOriginalExtension();
            $nomeImagem = time() . '_' . uniqid() . '.' . $extensao;
            $request->file('imagemRemedio')->move(public_path('img/users/fotosRemedios'), $nomeImagem);
        }

        $insert = remedio::create([
            'nome' => $request->nome,
            'horario' => $request->horario,
            'desc' => $request->desc,
            'termino' => $request->termino,
            'img' => $nomeImagem,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json([
            'mensagem'=>'Remedio cadastrado'
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
        $remedios = remedio::find($id);

        return response()->json([
            'remedios'=> $remedios
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
         $Remedio = remedio::find($id);
        $fotoRemedio = null;
       if ($request->hasFile('imgRemedio')) { 
                // Remove foto antiga se existir
    
                if ($Remedio->img && file_exists(public_path('img/users/fotosRemedios/' . $Remedio->img))) {
                    unlink(public_path('img/users/fotosRemedios/' . $Remedio->img));
                }

                $file = $request->file('imgRemedio'); // Pega o arquivo
                $extensao = $file->getClientOriginalExtension();
                $nomeImagem = 'fotoRemedio' . time() . '.' . $extensao;
                $file->move(public_path('img/users/fotosRemedios'), $nomeImagem); // Salva
                $fotoRemedio = $nomeImagem; // Atualiza no banco
            }
        $Remedio->update([
            'nome' => $request->nome,
            'desc' => $request->desc,
            'horario' =>  $request->horario,
            'termino' => $request->termino,           
            'img' => $fotoRemedio,
            'updated_at' => now()
        ]); 

        return response()->json([
            'message' => 'Remedio atualizado com sucesso',
            'code' => 200,
            'Remedio' => $Remedio
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        remedio::where('id', $id)->delete();

        return response()->json([
            'message' => 'remedio excluido',
            'code' => 200
        ]);
    }
    public function pesquisar($pesquisa)
    {
        $remedio = remedio::where('nome','like',"%$pesquisa%")->get();
        return $remedio;
    }
}
