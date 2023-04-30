<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    protected $table = "plannings";
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function cours() {
        return $this->belongsTo(Cour::class, 'cours_id');
    }
}
