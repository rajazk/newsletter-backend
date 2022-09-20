<?php
namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\UserSignup;
use Mail;
use App\Helpers\Response as R;

class NewsletterController extends Controller
{
    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email_address' => 'required|email|unique:newsletters'
        ]);

        if ($validator->fails()) {
            return R::ValidationError($validator->errors());
        }
        try {

            $res = Newsletter::create($request->all());
            Event::dispatch(new UserSignup($res));
            return R::Success('Email Added as recipient for newsletter', $res);            
        } catch (\Error $err) {
            return R::SimpleError('This Email doesnot registered with newsletter recipient');
        }
    }
}
