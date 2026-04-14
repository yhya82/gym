<?php

namespace App\Console\Commands;
use App\Models\Member;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Events\MemberStatusChanged;

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
    protected $description = 'Expire members whose end date have passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $members = Member::where('status','active')
                            ->whereDate('expiry_date','<=',now())
                            ->get();

                            if($members->isEmpty()){
                                $this->warn('No members found');
                                return;
                            }
                            

                            foreach($members as $member){
                                $member->status = 'expired';
                                $member->save();

                                //fire event

                                    event(new MemberStatusChanged($member));

                                Log::info('Expired member:' . $member->name);
                                
                            }
    
                            $this->info('Expired Members Count :'. $members->count());
    }
}
