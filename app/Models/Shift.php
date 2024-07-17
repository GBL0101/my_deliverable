<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    
    protected $fillable = ['teacher_id', 'timetable_id', 'lecture_id'];
    
    public function teacher(){
        
        return $this->belongsTo(Teacher::class);
    }
    
    public function timetable(){
        
        return $this->belongsTo(Timetable::class);
    }
    
    public function lecture(){
        
        return $this->belongsTo(Lecture::class);
    }
}
