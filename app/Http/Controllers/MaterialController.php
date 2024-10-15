<?php

namespace App\Http\Controllers;

use App\Models\material;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $data_material = material::all();
        return view('konten.material', [
            'material' => $data_material,
        ], compact('data_material'));
    }

    public function tampilanTambahMaterial()
    {
        return view('admin.tambahMaterial');
    }

    public function tambah(Request $request)
    {
        // Check uniqueness manually
        $inputValue = $request->input('id_material');
        $isUnique = DB::table('materials')
            ->where('id_material', $inputValue)
            ->doesntExist();
    
        if (!$isUnique) {

            return redirect()->back()->withErrors(['id_material' => 'This value is already taken.']);

        } else {

            $data = material::create($request->all());
            $data->save();

            return redirect('/material');
        }
    }

    public function showEdit($id)
    {
        $data_material = material::find($id);
        return view('admin.editMaterial', compact('data_material'));
    }

    public function updateData(Request $request, $id)
    {
        $data_material = material::find($id);
        $data_material->update($request->all());
        return redirect('/material');
    }

    public function deleteData($id)
    {
        $data_material = material::find($id);
        $data_material->delete();

        return redirect('/material');
    }
}
