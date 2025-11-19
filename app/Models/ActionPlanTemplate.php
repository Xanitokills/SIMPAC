<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionPlanTemplate extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'default_responsible',
        'predecessor_action',
        'default_business_days',
        'section',
        'order',
    ];

    /**
     * Obtener todas las plantillas ordenadas
     */
    public static function getAllOrdered()
    {
        return self::orderBy('order')->get();
    }

    /**
     * Obtener plantillas agrupadas por sección
     */
    public static function getBySection()
    {
        return self::orderBy('order')->get()->groupBy('section');
    }
}
