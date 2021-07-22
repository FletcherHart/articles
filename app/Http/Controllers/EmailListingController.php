<?php

namespace App\Http\Controllers;

use App\Models\EmailListing;
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
            $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_ALIAS') .'/members/pages';
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
        return Inertia::render('SendEmails');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_ALIAS') .'/members';
        $response = Http::withBasicAuth('api', getenv('MAILGUN_SECRET'))
            ->asForm()->post($page, ['address' => $validated['email']]);

        if($response->failed()) {
            return back()->with('error',  $response->json()['message']);
        }

        return back()->with('message', 'Email successfully subscribed.');
    }

    public function destroy($address) {
        $page = 'https://api.mailgun.net/v3/lists/'. getenv('MAILGUN_ALIAS') .'/members/' . $address;
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

        Mail::to(getenv('MAILGUN_ALIAS'))->send(new NewArticle($validated['emailTopic'],$validated['emailBody']));

        return back()->with('message', 'Emails sent. Please check your Mailgun account to check their progress.');
    }
}
