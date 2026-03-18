<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Jobs\ExpireMembers;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//not working
//Schedule::job(new ExpireMembers)->everyMinute(); 
//working 
Schedule::command('members:expire')->everyMinute();