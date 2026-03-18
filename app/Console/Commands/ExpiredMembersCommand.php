<?php

namespace App\Console\Commands;
use App\Models\Member;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;

class ExpiredMembersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Epire members whose end date have passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = Member::where('status','active')
                            ->whereDate('end_date','<=',now())
                            ->get();

                            foreach($members as $member){
                                $member->status = 'expired';
                                $member->save();

                                \Log::info('Expired member:' . $member->name);
                                
                            }

                            $this->info('Expired Member updated Succeffully.');
    }
}
