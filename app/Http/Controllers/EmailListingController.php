<?php

namespace App\Http\Controllers;

use App\Models\EmailListing;
use App\Mail\EmailSubscribe;
use App\Mail\NewArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class EmailListingController extends Controller
{
    public function index(Request $request) {

        $page = "";
        
        if($request['targetPage'] == null) {
            $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_LIST_ALIAS') .'/members/pages';
        } else {
            $page = $request['targetPage'];
        }

        $response = Http::withBasicAuth('api', getenv('MAILGUN_SECRET'))
            ->get($page);

        if($response->failed()) {
            return Inertia::render('EmailList', ['error' => $response->json()['message']]);
        }

        return Inertia::render('EmailList', ['addresses' => $response->json()['items'], 'pages' => $response->json()['paging']]);
    }

    public function send() {
        return Inertia::render('EmailCampaign');
    }

    public function confirmEmail(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        //Add as unsubscribed member to prevent dupes.
        $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_LIST_ALIAS') .'/members';
        $response = Http::withBasicAuth('api', getenv('MAILGUN_SECRET'))
            ->asForm()->post($page, ['address' => $request['email'], 'subscribed' => 'no']);

        if($response->failed()) {
            return back()->with('subscribeError',  $response->json()['message']);
        }

        //Send verification email
        $conf_code = md5($validated['email'].getenv('MAIL_HASH'));
        $email_html = (new EmailSubscribe($conf_code, $validated['email']))->render();

        $page = 'https://api.mailgun.net/v3/'. getenv('MAILGUN_ALIAS') .'/messages';
        $response = Http::withBasicAuth('api', getenv('MAILGUN_SECRET'))
            ->asForm()->post(
                $page, 
                [
                    'from' => getenv('APP_NAME') . '<' . getenv('MAILGUN_LIST_ALIAS') . '>',
                    'to' => $validated['email'], 
                    'subject' => "Mailing List Confirmation",
                    'html' => $email_html,
                ]
            );

        if($response->failed()) {
            return back()->with('subscribeError',  $response->json()['message']);
        }

        return back()->with('message', 'Confirmation email sent.');
    }

    public function store(Request $request) {

        if (md5($request['email'].getenv('MAIL_HASH')) != $request['code']) {
            return Inertia::render('ConfirmEmail', 
                [
                    'title' => "Confirmation Failed", 
                    'body' => "A problem occured trying to confirm this email."
                ]
            );
        }

        //Add member to mailing list
        $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_LIST_ALIAS') .'/members';
        $response = Http::withBasicAuth('api', getenv('MAILGUN_SECRET'))
            ->asForm()->post($page, ['address' => $request['email'], 'upsert' => 'yes']);

        if($response->failed()) {
            return Inertia::render('ConfirmEmail',  
                [
                    'title' => "Confirmation Failed", 
                    'body' => $response->json()['message']
                ]
            );
        }

        return Inertia::render('ConfirmEmail',  
            [
                'title' => "Confirmation Complete", 
                'body' => 'Email has been sucessfully subscribed.'
            ]
        );
        
    }

    public function destroy($address) {
        $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_LIST_ALIAS') .'/members/' . $address;
        $response = Http::withBasicAuth('api', getenv('MAILGUN_SECRET'))->delete($page);

        if($response->failed()) {
            if($response->status() == '404') {
                return back()->with('error',  'The email address "'. $address .'" is not on the mailing list.');
            }
            return back()->with('error',  $response->json()['message']);
        }

        return back();
    }

    public function sendEMail(Request $request)
    {
        $validated = $request->validate([
            'emailTopic' => 'required|string',
            'emailBody' => 'required|string',
        ]);

        Mail::to(getenv('MAILGUN_LIST_ALIAS'))->send(new NewArticle($validated['emailTopic'],$validated['emailBody']));

        return back()->with('message', 'Emails sent. Please check your Mailgun account to check their progress.');
    }
}
