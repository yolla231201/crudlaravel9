<?php

namespace App\Http\Controllers;

use Excel;
use PDF;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(5);
        }else {
            $data = Employee::paginate(5);
        }
        return view('siswa', compact('data'));
    }
    public function tambahsiswa(){
        return view('tambahdata');
    }
    public function insertdata(Request $request){
        // dd($request->all());
        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotosiswa/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('siswa')->with('success', 'Data berhasil ditambahkan');
    }
    public function tampilkandata($id){
        $data= Employee::find($id);
        return view('tampildata', compact('data'));
    }
    public function updatedata(Request $request, $id){
        $data= Employee::find($id);
        $data->update($request->all());
        return redirect()->route('siswa')->with('success', 'Data berhasil diupdate');
    }
    public function hapusdata($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('siswa')->with('success', 'Data berhasil dihapus');
    }
    public function exportpdf(){
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('datasiswa-pdf');
        return $pdf->download('data.pdf');

    }
    public function exportexcel(){
        return Excel::download(new EmployeeExport, 'datasiswa.xlsx');
    }
    public function importexcel(Request $request){
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport, public_path('/EmployeeData/'.$namafile));
        return \redirect()->back();
    }

}
