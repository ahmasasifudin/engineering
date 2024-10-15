<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\material;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index()
    {
        // $validatedData = YourModel::where('status', 'berhasil')->get();
        // return view('your.view', ['validatedData' => $validatedData]);
        // $data_report = Report::all();
        $data_report = Report::where('status', 'berhasil')->get();
        $data_validasi = Report::where('status', 'waiting')->get();
        return view('konten.report', [
            'report' => $data_report,
            'validasi' => $data_validasi
        ]);
    }

    public function accept($id)
    {
        $data = Report::findOrFail($id);
        $data->status = 'berhasil';
        $data->keterangan = 'confirmed';
        $data->save();

        return redirect('/report');
    }

    public function updateKeterangan(Request $request,$id)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);

        $data = Report::findOrFail($id);
        $keterangan = $request->input('keterangan');

        $data->keterangan = $keterangan;
        $data->save();

        return response()->json(['message' => 'Keterangan berhasil diperbarui.']);
    }
    
    public function tampilanTambahReport()
    {
        $materials = Event::all();
        return view('admin.tambahReport', compact('materials'));
    }

    public function getData($id)
    {
        $model = Event::where('id_material', $id)->get();
        return response()->json($model);
    }

    public function tambah(Request $request)
    {
        // $this->validate($request, [
        //     'file_report' => 'mimes:pdf'
        // ]);

        $validator = Validator::make($request->all(), [
            'file_report' => 'required|mimes:pdf',
        ], [
            'file.required' => 'This file must be have an input',
            'file.mimes' => 'Only PDF File is allowed to upload',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if (!$request) {

        //     return redirect()->back()->withErrors(['file_report' => 'Only PDF File is allowed to upload']);

         else {

            $dokumen = $request->file('file_report');
            $nama_dokumen = 'REPORT'.date('Ymdhis').'.'.$dokumen->getClientOriginalExtension();
            $dokumen->move('reports/',$nama_dokumen);
    
            $data = new Report();
            $data->id_material = $request->id_material;
            $data->material_name = $request->material_name;
            $data->thickness = $request->thickness;
            $data->month_test = $request->month_test;
            $data->date_test = $request->date_test;
            $data->file_report = $nama_dokumen;
            $data->save();
    
            return redirect('/report');
        }
    }

    public function viewReport($id)
    {
        $data = Report::find($id);
        return view('konten.view-report', compact('data'));
    }

    public function showEdit($id)
    {
        $data_report = Report::find($id);
        return view('admin.editReport', compact('data_report'));
    }

    public function updateData(Request $request, $id)
    {
        $rules = [
            'id_material' => 'required',
            'material_name' => 'required',
            'thickness' => 'required',
            'month_test' => 'required',
            'date_test' => 'required',
        ];
        
        // $request->validate([
        //     'file_report' => 'required|mimes:pdf',
        // ]);

        if ($request->hasFile('file_report')) {
            $rules['file_report'] = 'mimes:pdf';
        }

        $request->validate($rules);

        $data_report = Report::find($id);

        if ($request->hasFile('file_report')) {
            $report = $request->file('file_report');
            $nama_dokumen = 'REPORT'.date('Ymdhis') . '.' . $report->getClientOriginalExtension();
            // $report->storeAs('reports/', $nama_dokumen);
            $report->move(public_path('reports'), $nama_dokumen);

            if ($data_report->file_report) {
                $report_lama = public_path('reports/' . $data_report->file_report);
    
                if (file_exists($report_lama)) {
                    unlink($report_lama);
                }
            }

            $data_report->file_report = $nama_dokumen;
        }

        $data_report->id_material = $request->id_material;
        $data_report->material_name = $request->material_name;
        $data_report->thickness = $request->thickness;
        $data_report->month_test = $request->month_test;
        $data_report->date_test = $request->date_test;

        $data_report->save();

        return redirect('/report');
    }

    public function deleteData($id)
    {
        $data_report = Report::find($id);
        if ($data_report->file_report) {
            $file_path = public_path('reports/' . $data_report->file_report);
    
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $data_report->delete();

        return redirect('/report');
    }
}
