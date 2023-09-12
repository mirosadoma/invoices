<?php

namespace App\Http\Middleware;

use App\Support\API;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SMSJob;

class VerifiedPhoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('api')->check()) {
            return (new API)
                ->setMessage(__('unauthenticated'))
                ->setStatusUnauthorized()
                ->build();
        }
        if(is_null(Auth::guard('api')->user()->phone_verified_at)) {
            $user = Auth::guard('api')->user();
            auth('api')->logout();
            $verification_code = generate_code();
            $user->update(['verification_code' => $verification_code]);
            $msg_send = api_msg($request , 'رقم التأكيد هو  ' ,'Verfication Code Is  ');
            // SMS
            dispatch(new SMSJob($user, $msg_send. $user->verification_code));

            return (new API)
                ->isError(__('This user not verified').' '.__('And').' '.__('The activation code has been successfully sent'))
                ->setData(['email_or_phone'=>$user->phone, 'verification_code'=>$user->verification_code,'type'=>'verfied'])
                ->setStatus(320)
                ->build();
        }
        return $next($request);
    }
}
