<?php

namespace App\Observers;

use App\Models\Member;

class MemberObserver
{
    /**
     * Handle the Member "created" event.
     */
    public function created(Member $member): void
    {
        audit_log('created', $member, null , $member->toArray() );
    }

    /**
     * Handle the Member "updated" event.
     */
    public function updated(Member $member): void
    {
        audit_log('updated', $member, $member->getOriginal(), $member->getChanges());
    }

    /**
     * Handle the Member "deleted" event.
     */
    public function deleted(Member $member): void
    {
        audit_log('deleted', $member, $member->toArray(),null);
    }

    /**
     * Handle the Member "restored" event.
     */
    public function restored(Member $member): void
    {
        //
    }

    /**
     * Handle the Member "force deleted" event.
     */
    public function forceDeleted(Member $member): void
    {
        //
    }
}
