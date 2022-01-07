<?php

namespace Modules\Contacts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Contacts\Database\factories\ContactFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];
    
    protected static function newFactory()
    {
        return ContactFactory::new();
    }
}
