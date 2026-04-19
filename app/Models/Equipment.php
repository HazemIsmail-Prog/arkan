<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $appends = ['can_update', 'can_delete'];

    public function getCanUpdateAttribute(){
        return auth()->user()->hasPermissionTo('update_equipment');
    }

    public function getCanDeleteAttribute()
    {
        return auth()->user()->hasPermissionTo('delete_equipment');
    }
}
