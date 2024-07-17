<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    
    protected $fillable = ['student_count', 'booth_number'];
    
    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    
    public function shift(){
        
        return $this->belongsTo(Shift::class);
    }
}
