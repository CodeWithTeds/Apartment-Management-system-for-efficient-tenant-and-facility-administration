<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PropertyApplication;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PropertyApplicationForm extends Component
{
    use WithFileUploads;

    public $full_name;
    public $email;
    public $phone_number;
    public $property_name;
    public $property_address;
    public $description;
    public $document;
    public $verification_code;

    public $codeSent = false;

    public function sendCode()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $code = random_int(10000, 99999);
        session(['verification_code' => $code]);

        try {
            Mail::to($this->email)->send(new VerificationCodeMail($code));
            $this->codeSent = true;
            session()->flash('success', 'A verification code has been sent to your email.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send verification code. Please try again.');
        }
    }

    public function submitApplication()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'property_name' => 'required|string|max:255',
            'property_address' => 'required|string',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'verification_code' => 'required|numeric',
        ]);

        if ($this->verification_code == session('verification_code')) {
            $documentPath = $this->document->store('property_documents', 'public');

            PropertyApplication::create([
                'full_name' => $this->full_name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'property_name' => $this->property_name,
                'property_address' => $this->property_address,
                'description' => $this->description,
                'document_path' => $documentPath,
                'application_status' => 'pending',
            ]);

            session()->forget('verification_code');
            session()->flash('success', 'Your application has been submitted successfully!');
            $this->reset();
        } else {
            session()->flash('error', 'Invalid verification code.');
        }
    }

    public function render()
    {
        return view('livewire.property-application-form');
    }
}
