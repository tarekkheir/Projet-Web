<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    protected $table = "cours";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cours_users() {
        return $this->belongsToMany(User::class, 'cours_users', 'cours_id', 'user_id')
            ->withPivot('user_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formation() {
        return $this->belongsTo(Formation::class, 'formation_id');
    }

    public function plannings() {
        return $this->hasMany(Planning::class, 'cours_id');
    }
}
