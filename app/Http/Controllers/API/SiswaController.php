<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class SiswaController extends Controller
{
    public function index(){
        return [
            'data' => Siswa::all()
        ];
    }

    public function detail($id){
        $siswa = Siswa::find($id);
        if(empty($siswa)){
            return [
                'error' => 'siswa data not found'
            ];
        }

        return [
            'data' => $siswa
        ];
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'foto' => 'required|mimes:jpeg,jpg,png,gif',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $data = Siswa::create([
            'foto'      => $request->file('foto'),
            'nama'      => $request->get('nama'),
            'kelas'     => $request->get('kelas'),
            'angkatan'  => $request->get('angkatan'),
        ]);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('uploads/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        };

        return response()->json([
            "status" => "Created",
            "message" => "success",
            "data" => $data
        ], 201);
    }

    public function update(Request $request,$id){

        $check_data = Siswa::where('id', $id)->first();

        $validator = Validator::make($request->all(), [
            'foto' => 'required|mimes:jpeg,jpg,png,gif',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        if ($check_data) {
            $data = Siswa::find($id);
            $data->update([
                'foto'      => $request->file('foto'),
                'nama'      => $request->get('nama'),
                'kelas'     => $request->get('kelas'),
                'angkatan'  => $request->get('angkatan'),
            ]);

            if ($request->hasFile('foto')) {
                $request->file('foto')->move('uploads/', $request->file('foto')->getClientOriginalName());
                $data->foto = $request->file('foto')->getClientOriginalName();
                $data->save();
            };

            return response([
                'status' => 'OK',
                'message'=> 'Data Telah Diupdate',
                'data' => $data
            ], 200);   
        } else {
            return response([
                'status' => 'ERROR',
                'message'=> 'Data Tidak Ditemukan',
            ], 404);
        }
    }

    public function delete(Request $request,$id){
        $check_data = Siswa::where('id', $id)->first();

        if($check_data){
            $data = Siswa::find($id);
            $data->delete();

            return response()->json([
                'status' => 'OK',
                'message'=> 'Data Telah Dihapus'
            ]);
        } else {
            return response([
                'status' => 'ERROR',
                'message'=> 'Data Tidak Ditemukan',
            ], 404);
        }
    }
}
