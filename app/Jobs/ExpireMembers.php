<?php

namespace App\Jobs;
use App\Models\Member;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExpireMembers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        \Log::info('ExpireMembers job started at ' . now());
        $members = Member::where('status','active')
                    ->whereDate('end_date','<=', now())
                    ->get();

                    foreach($members as $member){
                        $member->status ='expired';
                        $member->save();

                        //send sms
                        $this->sendSms($member->phone,'Hello'.$member->name .'your gym subscription has expired');
                    }
                    
    }

            private function sendSms($phone ,$message){
                //use log for now then real sms later

                \log::info("SMS to {$phone}:{$message}");
            }
}
