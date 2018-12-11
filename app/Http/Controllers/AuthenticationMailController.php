<?php

namespace MailService\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use MailService\Events\UserPasswordReset;
use MailService\Events\UserRegistered;
use MailService\Jobs;
use Throwable;

class AuthenticationMailController extends Controller
{
    public function UserRegistered(Request $request)
    {
        try {
            event(new UserRegistered($request->email, $request->activation_code));

            $current_jobs = Jobs::all();

            $emails_scheduled = $current_jobs->count();

            $theoretical_time_to_process = $this->map($emails_scheduled, 0, 1000, 0, 10);

            return response()
                ->json(
                    ['request' => 'processed'
                        , 'email' => $emails_scheduled > 100 ? 'queued' : 'send'
                        , 'process_time' => $theoretical_time_to_process]
                );
        } catch (Throwable $error) {
            Log::error('UserRegisteredError', ["error" => $error]);
        }
    }
    public function UserPasswordReset(Request $request)
    {
        try {
            event(new UserPasswordReset($request->email, $request->reset_code));

            $current_jobs = Jobs::all();

            $emails_scheduled = $current_jobs->count();

            $theoretical_time_to_process = $this->map($emails_scheduled, 0, 1000, 0, 100);

            return response()
                ->json(
                    ['request' => 'processed'
                        , 'email' => $emails_scheduled > 100 ? 'queued' : 'send'
                        , 'process_time' => $theoretical_time_to_process]
                );
        } catch (Throwable $error) {
            Log::error('UserPasswordReset', ["error" => $error]);
        }
    }

    private function map($value, $from_low, $from_high, $to_low, $to_high)
    {
        $fromRange = $from_high - $from_low;
        $toRange = $to_high - $to_low;
        $scaleFactor = $toRange / $fromRange;

        // Re-zero the value within the from range
        $tmpValue = $value - $from_low;
        // Rescale the value to the to range
        $tmpValue *= $scaleFactor;
        // Re-zero back to the to range
        return $tmpValue + $to_low;
    }
}
