<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaBankCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mediaFiles()
    {

        return $this->belongsTo(MediaBank::class, 'media_bank_id','id');
    }

}
