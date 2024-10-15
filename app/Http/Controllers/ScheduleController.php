<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\material;
use App\Models\Report;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $data_schedule = Event::all();
        return view('konten.schedule', [
            'material' => $data_schedule,
        ], compact('data_schedule'));
    }

    public function tampilanTambahSchedule()
    {
        $materials = material::all();
        $suppliers = Supplier::all();
        return view('admin.tambahSchedule', compact('materials', 'suppliers'));
    }

    public function getData($id)
    {
        $model = material::where('id_material', $id)->get();
        return response()->json($model);
    }

    public function tambah(Request $request)
    {
        $data = Event::create($request->all());
        $data->save();

        return redirect('/schedule');
    }

    public function showEdit($id)
    {
        $data_schedule = Event::find($id);
        $suppliers = Supplier::all();
        return view('admin.editSchedule', compact('data_schedule', 'suppliers'));
    }

    public function updateData(Request $request, $id)
    {
        $data_schedule = Event::find($id);
        $data_schedule->update($request->all());
        
        return redirect('/schedule');
    }

    public function deleteData($id)
    {
        $data_schedule = Event::find($id);
        $data_schedule->delete();

        return redirect('/schedule');
    }
    
    public function detailCalendar()
    {
        $schedule = array();
        $penjadwalan = event::all();
        $results = DB::table('materials')
            ->join('reports', 'materials.id_material', '=', 'reports.id_material')
            ->select('materials.*', 'reports.date_test as date_test')
            ->get();

        // foreach($results as $result) {
        foreach($penjadwalan as $jadwal) {
            $checkResult = $jadwal->date_test;
            $color = null;
            if($checkResult >= $jadwal->month_test) {
                $color = '#68801A';
            } else {
                if($checkResult == '') {
                    $color = '#02F502';
                }
            }

            // $color = $checkResult !== null ? '#68801A' : '#924ACE';
            
            $schedule[] = [
                'title' => $jadwal->id_material,
                'start' => $jadwal->month_test,
                'end' => $jadwal->month_test,
                'color' => $color,
            ];
        }

        return view('konten.view-schedule', ['schedule' => $schedule]);
    }
}
