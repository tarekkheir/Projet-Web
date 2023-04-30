<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = "users";
    public $timestamps = false;
    protected $hidden = ['mdp'];
    protected $fillable = ['login', 'name', 'mdp', 'type'];
    protected $attributes = ['type' => 'user'];

    public function getAuthPassword() {
        return $this->mdp;
    }

    public function isAdmin() {
         return $this->type == 'admin';
    }

    public function isEtudiant() {
        return $this->type == 'etudiant';
    }

    public function isEnseignant() {
        return $this->type == 'enseignant';
    }

    public function cours_users() {
        return $this->belongsToMany(Cour::class, 'cours_users', 'user_id', 'cours_id')
            ->withPivot('cours_id');
    }

    public function cours() {
        return $this->hasMany(Cour::class, 'user_id');
    }

    public function formation() {
        return $this->belongsTo(Formation::class, 'formation_id');
    }
}
