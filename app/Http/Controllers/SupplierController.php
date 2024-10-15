<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data_supplier = Supplier::all();
        return view('konten.supplier', [
            'supplier' => $data_supplier,
        ], compact('data_supplier'));
    }

    public function tampilanTambahSupplier()
    {
        return view('admin.tambahSupplier');
    }

    public function tambah(Request $request)
    {
        $data = Supplier::create($request->all());
        $data->save();

        return redirect('/supplier');
    }

    public function showEdit($id)
    {
        $data_supplier = Supplier::find($id);
        return view('admin.editSupplier', compact('data_supplier'));
    }

    public function updateData(Request $request, $id)
    {
        $data_supplier = Supplier::find($id);
        $data_supplier->update($request->all());
        
        return redirect('/supplier');
    }

    public function deleteData($id)
    {
        $data_supplier = Supplier::find($id);
        $data_supplier->delete();

        return redirect('/supplier');
    }
}
