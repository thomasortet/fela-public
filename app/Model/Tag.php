<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug', 'parent_tag_name'];
    public $timestamps = false;

    public function episodes()
    {
    return $this->belongsToMany(Episode::class);
    }
}
