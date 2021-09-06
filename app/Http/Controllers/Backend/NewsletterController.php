<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Newsletter;

use Mail;
use App\Mail\NewsletterMailer;


use validator;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletter = Newsletter::all()->sortByDesc('id');
        return view('backend.newsletter.index',compact('newsletter'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Newsletter::find($id);
        $user->delete();
        return redirect('newsletter')->with('success', 'Subscriber deleted!');
    }

    /**
     * Sent Mail
     * @return \Illuminate\Http\Response
     */
    public function sendmail(Request $request)
    {
 
        

        $MailData = $request->validate(
            [
                'subject'=>'required',
                'content'=>'required',
                'subscribers' => 'required',
            ]
        );
       
        
        foreach($MailData['subscribers'] as $subscriber)
        {
            $subInfo = Newsletter::find($subscriber);            
            $to  =  $subInfo->email;
            $MailData['name'] = $subInfo->name;
            Mail::to($to)->queue(new NewsletterMailer( $MailData ));
        }
        return redirect('newsletter')->with('success', 'Mail sent');
    }
}
