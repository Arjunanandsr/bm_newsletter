<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

use Validator;

class SubscriberController extends Controller
{
    /**
     * Store a new subscriber.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = array(
            'unique' => 'Already in list, thank you.',
        );

        $validation = Validator::make(
            $request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|unique:newsletters|email:rfc,dns|max:255',
            ]
        );

        if ($validation->fails()) {
             return response()->json(['status'=>false,'errors'=>$validation->messages()], 401);
        }

        $data = $request->only(['name', 'email']);
   
        $newsletter = new Newsletter($data);
        $newsletter->save();
        $json['status']     = true;
		$json['message']    =  'Thank you for your interest';
        return response()->json($json, 200);
    }
}
