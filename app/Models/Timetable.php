<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'start_time', 'end_time'];
    
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
    
    public function shifts(){
        
        return $this->hasMany(Shift::class);
    }
    
    public function schedules(){
        
        return $this->hasMany(Schedule::class);
    }
    
    
}
