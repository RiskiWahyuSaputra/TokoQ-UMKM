<?php

namespace App\Traits;

use App\Models\AuditLog;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            self::log('create', $model, null, $model->toArray());
        });

        static::updated(function ($model) {
            self::log('update', $model, $model->getOriginal(), $model->toArray());
        });

        static::deleted(function ($model) {
            self::log('delete', $model, $model->toArray(), null);
        });
    }

    protected static function log(string $action, $model, $old, $new)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => $action,
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'old_values' => $old,
                'new_values' => $new,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'description' => ucfirst($action) . ' ' . class_basename($model) . ' #' . $model->id,
            ]);
        }
    }
}
