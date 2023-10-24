<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Jobs\SendCodeToMobile;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    public function store(Request $request)
    {
        $times = session('send_mobile_code_times',1);

        session(['send_mobile_code_times'=>1]);


        if($times>5){
            throw ValidationException::withMessages([
                'mobile' => 'please try later, you tried many times.',
            ]);
        }

        session(['send_mobile_code_times'=>$times+1]);




        $request->validate([
            'mobile' => 'required|string|regex:/^09[0-9]{8,9}$/',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $message_title = 'reset code from mywebsite.com';
        $code= random_int(111111,999999);
        $message_content = 'your message code is : '.$code;

        $user = User::where('mobile',$request->input('mobile'))->first();

        if(!$user){
            throw ValidationException::withMessages([
                'mobile' => 'your mobile not registered',
            ]);
        }

        $status = SendCodeToMobile::dispatch($user,$message_title,$message_content,$code);

        if ($status) {
            return redirect(route('password.confirm'))->with('status','code successfully sent to mobile');
        }

        throw ValidationException::withMessages([
            'mobile' => 'error send code to mobile',
        ]);
    }
}
