<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use Validator;

class SiswaController extends Controller
{   

    public function __construct(){
        $this->middleware('CheckLogin');
    }

    public function index(){

        $data = Siswa::all();
        return view('siswa', compact('data'));

    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'foto' => 'required|mimes:jpeg,jpg,png,gif',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
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

        return redirect('siswa')->with('success','Data Berhasil Ditambahkan');
    }

    public function showFormUpdate($id){
        $check_data = Siswa::where('id', $id)->first();

        if($check_data){
            $data = Siswa::find($id);
            return view('siswaFormUpdate', compact('data'));
        } else {
            return redirect('siswa')->with('errorr','Data Tidak Ditemukan!');
        }
        
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'foto' => 'required|mimes:jpeg,jpg,png,gif',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

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

        if ($data) {
            return redirect('siswa')->with('success','Data Berhasil Ditambahkan');
        } else {
            return redirect('siswaEdit/{id}')->with('errorr', 'Data Gagal Ditambahkan');
        }
    }

    public function delete($id){

        $check_data = Siswa::where('id', $id)->first();

        if($check_data){
            $data = Siswa::find($id);
            $data->delete();
            return redirect('siswa')->with('success','Data Berhasil Dihapus!');
        } else {
            return redirect('siswa')->with('errorr','Data Gagal Dihapus!');
        }

    }
}
