<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequiredApproval extends Model
{
    protected $appends = ['can_update', 'can_delete'];

    public function getCanUpdateAttribute(){
        return auth()->user()->hasPermissionTo('update_requiredapproval');
    }

    public function getCanDeleteAttribute()
    {
        return auth()->user()->hasPermissionTo('delete_requiredapproval');
    }
}
