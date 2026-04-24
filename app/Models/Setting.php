<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
