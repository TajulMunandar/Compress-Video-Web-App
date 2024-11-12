<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function setDirAttribute($value)
    {
        // Cek jika nilai berakhiran .bin, ganti menjadi .mp4
        if (str_ends_with($value, '.bin')) {
            $this->attributes['dir'] = str_replace('.bin', '.mp4', $value);
        } else {
            $this->attributes['dir'] = $value;
        }
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
