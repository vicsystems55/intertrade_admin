<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mediaCategory()
    {

        return $this->hasMany(MediaBankCategory::class)->latest();
    }

}
