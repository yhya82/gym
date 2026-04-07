<?php
use App\Models\AuditLog;


function audit_log($action, $model, $old = null, $new = null){

      $log = AuditLog::create([

            'user_id' => auth()->id(),
            'action' => $action,
            'target_type'=> class_basename($model),
            'target_id'=> $model->id ?? null,
            'old_values'=> $old,
            'new_values'=> $new,
            'description' => $action.''.class_basename($model)

       ]);

       \Log::info('Audit Log Created:', $log->toArray());
}