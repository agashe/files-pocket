<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * Make all fields fillable.
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Get file's folder.
     * 
     * @return \BelongsTo
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
}
