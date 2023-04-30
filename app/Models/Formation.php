<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $table = "formations";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function users() {
        return $this->hasMany(User::class, 'formation_id');
    }

    public function cours() {
        return $this->hasMany(Cour::class, 'formation_id');
    }
}
