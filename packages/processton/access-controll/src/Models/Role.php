<?php

namespace Processton\AccessControll\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name',
        'guard_name',
    ];
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'assigned_persmissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
    public function assignedPermissions()
    {
        return $this->hasMany(AssignedPersmission::class);
    }
}
