<?php

namespace App\Http\Controllers;

use App\Models\EmailListing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use SendGrid\Mail\Mail;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

class EmailListingController extends Controller
{
    public function index() {
        return Inertia::render('EmailList');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email|unique:email_listings',
        ]);

        EmailListing::firstOrCreate(['email' => $request['email']]);

        return redirect('dashboard');
    }

    /**
     * push array in key/value pairs
     */
    protected function array_push_assoc(&$array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    public function sendEMail(Request $request)
    {
        $validated = $request->validate([
            'emailTopic' => 'required|string',
            'emailBody' => 'required|string',
        ]);

        $from = getenv('SENDER_EMAIL');
        $topic = $validated['emailTopic'];
        $addresses = EmailListing::all();
        $receivers = [];
        $emailContent = $validated['emailBody'];

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($from, "Finance Master");
        $email->setSubject($topic);
        // $email->addTos($receivers);
        $email->addContent("text/plain", $emailContent);

        foreach($addresses as $address){
            $personalization = new Personalization;
            $personalization->addTo(new To($address->email));
            $personalization->setSubject(new Subject($topic));
            $email->addPersonalization($personalization);
            //array_push($receivers, $address->email);
        }
        
        $sendgrid = new \SendGrid(getenv('SENDGRID_KEY'));

        try {
            $response = $sendgrid->send($email);
            return response()->json("Email sent successfully");

        } catch (Exception $e) {
            return response()->json( 'Caught exception: '. $e->getMessage() ."\n");
        }
    }
}
