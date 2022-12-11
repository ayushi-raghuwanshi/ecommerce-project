<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permission;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'status'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
