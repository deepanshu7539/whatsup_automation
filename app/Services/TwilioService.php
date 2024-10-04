<?php

namespace App\Services;

use Twilio\Rest\Client;
use Exception;

class TwilioService
{
    protected $twilio;

    public function __construct()
    {
        // Initialize the Twilio client with credentials from the environment variables
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    /**
     * Send a WhatsApp message using Twilio API.
     *
     * @param string $to The recipient's phone number.
     * @param string $message The message body to be sent.
     * @param string|null $contentSid Optional content SID for the message.
     * @return string The message SID if sent successfully, or an error message.
     */
    public function sendWhatsAppMessage($to, $message, $contentSid = null)
    {
        try {
            $messageOptions = [
                'from' => "whatsapp:" . env('TWILIO_WHATSAPP_NUMBER'),
                'body' => $message,
            ];

            // Include content_sid if provided
            if ($contentSid) {
                $messageOptions['content_sid'] = $contentSid;
            }

            // Create the message
            $message = $this->twilio->messages->create(
                "whatsapp:$to", // recipient
                $messageOptions
            );

            return $message->sid; // Return message SID for logging
        } catch (Exception $e) {
            // Return the error message in case of a failure
            return 'Failed to send: ' . $e->getMessage();
        }
    }
}
