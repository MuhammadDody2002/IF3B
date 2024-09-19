<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::with('fakultas')->get();
        $data['message'] = true;
        $data['result'] = $prodi;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request -> validate([
            'nama' => 'required|unique:fakultas',
            'fakultas_id' => 'required'

        ]);
        $result = Prodi::create($validate);

        if($result){
            $data['succes'] = true;
            $data['message'] = "Data Prodi berhasil disimpan";
            $data['result'] = $result;
            return response()->json($data, Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $id)
    {
        $validate = $request->validate([
            'nama' => 'required',
            "fakultas-id" => 'required'
        ]);

        $result = Prodi::where('id', $id)->update($validate);
        if ($result) {
            $data['succes'] = true;
            $data['message'] = 'Data Prodi berhasil di update';
            $data['result'] = $result;
            return response()->json($data, Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $id)
    {
        $prodi = Prodi::find($id);
        if ($prodi) {
            $prodi->delete();
            $data['succes'] = true;
            $data['message'] = "Data Prodi berhasil di hapus";
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['succes'] = false;
            $data['message'] = "Data Prodi Tidak ditemukan";
            return response()->json($data, Response::HTTP_OK);
        }
    }
}
