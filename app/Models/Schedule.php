<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    // protected $fillable = ['name', 'start_date', 'end_date'];
    
    public function student(){
        
        return $this->belongsTo(Student::class);
    }
    
    public function timetable(){
        
        return $this->belongsTo(Timetable::class);
    }
    
    public function lecture(){
        
        return $this->belongsTo(Lecture::class);
    }
}
