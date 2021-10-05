<?php
namespace Modules\Common\Traits;

use Illuminate\Support\Str;

/**
 * Trait UsesUUid
 * @package Modules\Common\Traits
 * 
 * @method whereUuid($uuid)
 */
trait UsesUuid
{

    /**
     * Booted function from laravel
     */
    protected static function booted()
    {
        parent::booted();
        static::creating(function($model){
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public static function findUuid($uuid)
    {
        return static::whereUuid($uuid)->firstOrFail();
    }
}