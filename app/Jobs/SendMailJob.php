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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    protected $smtp_host;
    protected $smtp_user;
    protected $smtp_pass;
    protected $smtp_enc;
    protected $smtp_port;

    public function __construct($data, $add, $status)
    {
        $this->from = $data['from'];
        $this->mail = $data['mail'];
        $this->subject = $data['subject'];
        $this->company = $data['company'];
        $this->history_id = $data['history_id'];
        $this->smtp_host = $data['smtp_host'];
        $this->smtp_user = $data['smtp_user'];
        $this->smtp_pass = $data['smtp_pass'];
        $this->smtp_enc = $data['smtp_enc'];
        $this->smtp_port = $data['smtp_port'];
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
        /*
            $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://be.trustifi.com/api/i/v1/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"recipients\":[{\"email\":\"{$recipient}\"}],\"title\":\"{$this->subject}\",\"html\":\"{$this->mail}\"}",
            CURLOPT_HTTPHEADER => array(
                "x-trustifi-key: fff4f466004b3a910ce862b85a1e4310c663f6c6cdc9e84a",
                "x-trustifi-secret: a2fd45c72edd275f4a4d3fc436e1fba0",
                "content-type: application/json"
            )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $history = MailHistory::find($this->history_id);
            $current_failed = $history->failed !== '' ? explode(",",$history->failed) : [];
            $current_failed[] = $recipient;
            $failed_str = implode(",", $current_failed);
            $history->update(['failed' => $failed_str]);
        }
        */


        $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $this->smtp_host;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $this->smtp_user;                     //SMTP username
                $mail->Password   = $this->smtp_pass;                               //SMTP password
                $mail->SMTPSecure = $this->smtp_enc;            //Enable implicit TLS encryption
                $mail->Port       = $this->smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($this->from, $this->company);
                $mail->addAddress($recipient);     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $this->subject;
                $mail->Body    = $this->mail;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
            } catch (Exception $e) {
                $history = MailHistory::find($this->history_id);
                info("history {$this->history_id} ".json_encode($history));
                $current_failed = $history->failed !== '' ? explode(",",$history->failed) : [];
                $current_failed[] = $recipient;
                $failed_str = implode(",", $current_failed);
                $history->update(['failed' => $failed_str]);
                //info("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }

            /*
            try {
               // Mail::to($recipient)->send(new MailMark($this->from, $this->mail, $this->subject, $this->company));
               Mail::send('emails.mailhtml', [
                'mail' => $this->mail,
                'subject' => $this->subject,
                'company_name' => $this->company
            ], function ($m) use($recipient){
                $m->from($this->from, $this->company);
                $m->to($recipient)->subject($this->subject);
            });
            } catch (\Throwable $th) {
                

                $history = MailHistory::find($this->history_id);
                $current_failed = $history->failed !== '' ? explode(",",$history->failed) : [];
                $current_failed[] = $recipient;
                $failed_str = implode(",", $current_failed);
                $history->update(['failed' => $failed_str]);
                //throw $th;
            }
            */
            
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
