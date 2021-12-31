<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\ExportStatuses;
use App\Models\MailHistory;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SendMailController extends Controller
{
    public function sendEmail(Request $request)
    {    
        $request->validate([
            'from' => 'required',
            'mail' => 'required',
            'subject' => 'required',
            'addresses' => 'required',
            'smtp_host' => 'required',
            'smtp_user' => 'required',
            'smtp_pass' => 'required',
            'smtp_enc' => 'required',
            'smtp_port' => 'required'
        ]);
        $add = explode(",", $request->addresses);
        $saved = MailHistory::create([
            'id' => mt_rand(100, 999).time(),
            'from' => $request->from,
            'mail' => $request->mail,
            'subject' => $request->subject,
            'company' => $request->company_name,
            'failed' => '',
            'username' => $request->username,
            'addresses' => $request->addresses
          ]);
        $data = [
            'from' => $request->from,
            'mail' => $request->mail,
            'subject' => $request->subject,
            'company' => $request->company_name,
            'history_id' => $saved->id,
            'smtp_host' => $request->smtp_host,
            'smtp_user' => $request->smtp_user,
            'smtp_pass'=> $request->smtp_pass,
            'smtp_enc' => $request->smtp_enc,
            'smtp_port' => $request->smtp_port
        ];
        $number = 'mailer'.mt_rand(100, 999).time(); // better than rand()
        $status = ExportStatuses::create([
            'id' => mt_rand(100, 999).time(),
            'token' => $number,
            'percentage' => 0,
            'batches' => count(array_chunk($add, 10))
          ]);
        SendMailJob::dispatch($data, $add, $status);
        return response([
            'message' => 'Sending mail...',
            'status' => $status
        ], 200);
   
    }

    public function clearStatus(Request $request)
    {
        $request->validate([
            'statusId' => 'required'
        ]);
        $status = ExportStatuses::where('id', $request->statusId)->delete();
        return response([
            'message' => 'Status cleared',
        ], 200);
    }

    public function getHistory(Request $request)
    {
        $user = Auth::user();
        info("user ".json_encode($user));
        if($request->del){
            MailHistory::where('username', $request->username)->where('id', $request->del)->delete(); 
        }
        $all = MailHistory::where('username', $request->username)->count();
        $from = is_numeric($request->from) ? $request->from  : 0;
        $data = MailHistory::where('username', $request->username)->orderBy('created_at', 'DESC')->skip($from)->take(10)->get();
        if($data) {
            $showed = $from + 10;
            $next = $all > $showed ? $showed : 0;
            $prev = $from > 0 ? $from - 10 : 0;
            $meta = (object)['nav' => $all > 10, 'next' => $next, 'prev' => $prev];
            return response([
                'message' => 'history found',
                'data' => $data,
                'meta' => $meta
            ], 200);
        } else {
            return response([
                'message' => 'history not found',
                'data' => null
            ], 404);
        }
    
    }

    public function getStatus(Request $request)
    {
        $request->validate([
            'statusId' => 'required'
        ]);
        $status = ExportStatuses::find($request->statusId);
        if($status) {
            return response([
                'message' => 'Status found',
                'status' => $status
            ], 200);
        } else {
            return response([
                'message' => 'Status not found',
                'status' => null
            ], 404);
        }
        
    }

}