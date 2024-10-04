<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WhatsAppController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function showForm()
    {
        return view('upload'); // View to upload CSV file
    }

    public function sendMessages(Request $request)
{
    // Validate and handle file upload
    $request->validate([
        'contacts_file' => 'required|mimes:csv,txt',
    ]);

    $path = $request->file('contacts_file')->store('uploads');
    $file = Storage::get($path);
    $rows = array_map('str_getcsv', explode("\n", $file));

    foreach ($rows as $row) {
        $phone = $row[0]; // Assuming the phone number is in the first column
        $messageBody = "Hello, this is a test WhatsApp message"; // Customize as needed
        
        // Send WhatsApp message with content_sid
        $contentSid = "HXe709bfb32ccfcc0821ad92cb0529f26e"; // Your content_sid
        $messageSid = $this->twilioService->sendWhatsAppMessage($phone, $messageBody, $contentSid);

        // Store the message details in the database
        DB::table('sent_messages')->insert([
            'phone' => $phone,
            'message_sid' => $messageSid,
            'status' => $messageSid ? 'Sent' : 'Failed',
            'created_at' => Carbon::now()
        ]);
    }

    return back()->with('success', 'Messages sent successfully!');
}

}
