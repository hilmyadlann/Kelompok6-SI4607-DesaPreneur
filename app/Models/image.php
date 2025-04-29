<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;

    protected $fillable = ['umkms_id', 'image_path'];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

}
