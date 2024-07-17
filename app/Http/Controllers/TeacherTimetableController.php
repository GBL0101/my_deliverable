<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Shift;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherTimetableController extends Controller
{
    
    public function show()
    {
        return view("teacher/calendar/calendar");
    }
    
    
    public function store(Request $request, Timetable $timetable)
    {
        // $timetable = new Timetable;

        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $timetable->start_time = date('Y-m-d H:i:s', $request->input('start_time') / 1000);
        $timetable->end_time = date('Y-m-d H:i:s', $request->input('end_time') / 1000);
        $timetable->name = $request->input('name');
        $timetable->save();
        
        return $timetable;
    }
    
    
    public function getEvent(Request $request, Teacher $teacher, Timetable $timetable, Shift $shift)
    {
        // カレンダー表示期間
        $start_time = date('Y-m-d H:i:s', $request->input('start_time') / 1000);
        $end_time = date('Y-m-d H:i:s', $request->input('end_time') / 1000);
    
        // 登録処理
        $teacher = Auth::guard('teacher')->user();
        
        $timetableData = $timetable->query()
            ->select(
                // FullCalendarの形式に合わせる
                'start_time as start',
                'end_time as end',
                'name as title',
                'id'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('end_time', '>', $start_time)
            ->where('start_time', '<', $end_time)
            ->get();//id取得
            
        $shiftData = $shift->query()
            ->join('timetables', 'shifts.timetable_id', '=', 'timetables.id')
            ->select(
                'start_time as start',
                'end_time as end',
                'name as title',
                'timetable_id as id'
            )
            ->where('teacher_id', '=', $teacher->id)
            ->where('end_time', '>', $start_time)
            ->where('start_time', '<', $end_time)
            ->get();
            
        
        $data = [
                "class" => $timetableData,
                "shift" => $shiftData
        ];
        
        return $data;
        
        
        
        
        // return $timetable->query()
        //     ->select(
        //         // FullCalendarの形式に合わせる
        //         'start_time as start',
        //         'end_time as end',
        //         'name as title',
        //         'id'
        //     )
        //     // FullCalendarの表示範囲のみ表示
        //     ->where('end_time', '>', $start_time)
        //     ->where('start_time', '<', $end_time)
        //     ->get();//id取得
    }
    
    
    public function update(Request $request, Timetable $timetable, Shift $shift, Teacher $teacher){
        $teacher = Auth::guard('teacher')->user();
        // dd($teacher->id);
        $input = new Shift();
        $input->timetable_id = $request->input('id');
        $input->teacher_id = $teacher->id;
        $input->lecture_id = null;
        $shift->fill($input->attributesToArray())->save();
        // $input->name = $request->input('name');
        // $input->start_time = $request->input('start_time');
        // $input->end_time = $request->input('end_time');
        
        // $timetable->find($request->input('id'))->fill($input->attributesToArray())->save();
        
        return redirect(route("teacher.timetable.show"));
    }
}
