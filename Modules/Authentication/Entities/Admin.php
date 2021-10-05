<?php

namespace Modules\Admin\Entities;

use Modules\Common\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, UsesUuid;

    /**
     * Mass assignable attributes
     * 
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number'
    ];

    /**
     * Attributes that should be hidden
     * 
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Attributes that should be cast to native types
     * 
     * @var array
     */
    protected $casts = [];
    
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\AdminFactory::new();
    }
}
