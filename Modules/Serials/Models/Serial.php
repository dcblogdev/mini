<?php

namespace Modules\Serials\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Serials\Database\factories\SerialFactory;

class Serial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'serial', 'notes'];
    
    protected static function newFactory(): SerialFactory
    {
        return SerialFactory::new();
    }
}
