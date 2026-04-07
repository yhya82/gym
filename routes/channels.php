<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('members', function($user){
    return $user !==null;
});
Broadcast::channel('payments', function($user){
    return $user !==null;
});