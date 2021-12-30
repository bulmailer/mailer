<?php

namespace App\Jobs;

use App\Mail\MailMark;
use App\Models\ExportStatuses;
use App\Models\MailHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $from;
    protected $mail;
    protected $subject;
    protected $addresses;
    protected $status;
    protected $company;
    protected $history_id;
    public function __construct($data, $add, $status)
    {
        $this->from = $data['from'];
        $this->mail = $data['mail'];
        $this->subject = $data['subject'];
        $this->company = $data['company'];
        $this->history_id = $data['history_id'];
        $this->addresses = $add;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipient_array = array_chunk($this->addresses, 10);
        $status = ExportStatuses::find($this->status->id);
        $each_perc = 100 / $status->batches;

        foreach ($recipient_array[0] as $key => $recipient) {
            try {
               // Mail::to($recipient)->send(new MailMark($this->from, $this->mail, $this->subject, $this->company));
               Mail::send('emails.mailhtml', [
                'mail' => $this->mail,
                'subject' => $this->mail_subject,
                'company_name' => $this->company_name
            ], function ($m) use($recipient){
                $m->from($this->from, "from person");
                $m->to($recipient, 'TEST')->subject($this->mail_subject);
            });
            } catch (\Throwable $th) {
                

                $history = MailHistory::find($this->history_id);
                $current_failed = $history->failed !== '' ? explode(",",$history->failed) : [];
                $current_failed[] = $recipient;
                $failed_str = implode(",", $current_failed);
                $history->update(['failed' => $failed_str]);
                //throw $th;
            }
            
            //info("recipient ".$recipient);
        }
        $new_perc = $status->percentage + $each_perc;
        $status->update(['percentage' =>  $new_perc > 100 ? 100 : $new_perc]);
        if(count($recipient_array) > 1) {
            $next_recipient = array_shift($recipient_array);
            $data = [
                'from' => $this->from,
                'mail' => $this->mail,
                'subject' => $this->subject,
                'company' => $this->company,
                'history_id' => $this->history_id
            ];
            
            SendMailJob::dispatch($data, collect($recipient_array)->flatten()->toArray(), $status);
        } else {
            if($new_perc > 100) {
                $status->update(['percentage' => 100]);
            }
        }
        
    }
}
