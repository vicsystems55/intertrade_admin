<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaBank extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function uploadedBy()
    {

        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }

    public function project()
    {

        return $this->belongsTo(Project::class, 'project_id', 'id');
    }



}
