<?php

namespace App\Models;

use App\Models\JenisMapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function jenisMapel()
    {
        return $this->belongsTo(JenisMapel::class, 'jenis_mapel_uuid', 'uuid');
    }
}
