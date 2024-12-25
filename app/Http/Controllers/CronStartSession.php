<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CronStartSession extends BaseController
{
    
    public function index()
    { 
        $sessions = Session::where('is_default', 1)->first();
        $currentMonth = date('m-Y');
        $currentDate = \DateTime::createFromFormat('m-Y', $currentMonth)->format('m');
        $endDate = \DateTime::createFromFormat('m-Y', $sessions->end_year)->format('m');   
        if ($endDate < $currentDate) {
            $old_session = Session::query()->update(['is_default' => 0]);
            $nextYear = Carbon::now()->addYear()->year; // Next year
            $new_session = Session::create(['is_default' => 1,'start_year' => $sessions->end_year,'end_year' => $endDate.'-'.$nextYear]);
            $user_session = User::query()->update(['session_id' => $new_session->id,'old_session_id' => $sessions->id]);
        }
        
    }                     
       
    

}



