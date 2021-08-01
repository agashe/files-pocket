<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    /**
     * Make all fields fillable.
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Get folder's parent.
     * 
     * @return \BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id', 'id');
    }

    /**
     * Get folder's children.
     * 
     * @return \HasMany
     */
    public function children()
    {
        return $this->hasMany(Folder::class);
    }
    
    /**
     * Get folder's files.
     * 
     * @return \HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
