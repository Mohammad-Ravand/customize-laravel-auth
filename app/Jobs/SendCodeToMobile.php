<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\MobileMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendCodeToMobile
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    protected User $user;
    protected string $title;
    protected string $message;
    protected int $code;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $title, string $message,int $code)
    {
        $this->user = $user;
        $this->title = $title;
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        /**
         * !Note
         *send message to user in real senario we
         *  send http request for some where and get result to save in database
         */

        $status = false;

        DB::transaction(function (){

            $status = $this->user->messages()->create([
                'title'=> $this->title,
                'message'=>$this->message
            ]);

            $this->user->update([
                'password'=>Hash::make($this->code)
            ]);

        });

        $status = $status ? true :  false;

        return $status;
    }
}
