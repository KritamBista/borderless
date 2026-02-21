<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\EmailOtp;
use App\Mail\VerifyOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Component
{
    // read-only display
    public string $name = '';
    public string $email = '';
    public ?string $phone = null;

    // phone save (only if null)
    public ?string $new_phone = null;

    // password change flow
    public int $step = 1; // 1 = send otp, 2 = verify otp & set password
    public string $otp = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;

        if (!$this->phone) {
            $this->new_phone = '';
        }
    }

    private function sendOtpTo(string $email, string $purpose = 'change_password'): void
    {
        $code = (string) random_int(100000, 999999);

        // invalidate old unused OTPs for same purpose
        EmailOtp::where('email', $email)
            ->where('purpose', $purpose)
            ->whereNull('used_at')
            ->update(['used_at' => now()]);

        EmailOtp::create([
            'email' => $email,
            'purpose' => $purpose,
            'code_hash' => bcrypt($code),
            'expires_at' => now()->addMinutes(10),
        ]);

        // Reuse your existing mail template/class
        Mail::to($email)->send(new VerifyOtpMail($code));
    }

    public function sendChangePasswordOtp()
    {
        // basic rate limiting: block if last OTP created < 60s ago (optional but good)
        $last = EmailOtp::where('email', $this->email)
            ->where('purpose', 'change_password')
            ->latest()
            ->first();

        if ($last && $last->created_at->gt(now()->subSeconds(60))) {
            $this->addError('otp', 'Please wait a moment before requesting another OTP.');
            return;
        }

        $this->resetErrorBag('otp');
        $this->sendOtpTo($this->email, 'change_password');

        $this->step = 2;
        $this->otp = '';
        session()->flash('success', 'OTP sent to your email.');
    }

    public function savePhoneIfEmpty()
    {
        $user = auth()->user();
        if ($user->phone) return; // already set

        $this->validate([
            'new_phone' => 'required|min:7|max:30',
        ]);

        $user->update(['phone' => $this->new_phone]);
        $this->phone = $user->phone;

        session()->flash('success', 'Phone number saved.');
    }

    public function verifyOtpAndChangePassword()
    {
        $this->validate([
            'otp' => 'required|digits:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $row = EmailOtp::where('email', $this->email)
            ->where('purpose', 'change_password')
            ->whereNull('used_at')
            ->latest()
            ->first();

        if (!$row || now()->greaterThan($row->expires_at)) {
            $this->addError('otp', 'OTP expired. Please resend.');
            return;
        }

        if (!Hash::check($this->otp, $row->code_hash)) {
            $row->increment('attempts');
            $this->addError('otp', 'Invalid OTP.');
            return;
        }

        $row->update(['used_at' => now()]);

        // change password
        $user = auth()->user();
        $user->update([
            'password' => bcrypt($this->new_password),
        ]);

        // optional: if phone is empty and user entered it, save it here too
        if (!$user->phone && $this->new_phone && trim($this->new_phone) !== '') {
            $user->update(['phone' => $this->new_phone]);
            $this->phone = $user->phone;
        }

        // reset UI
        $this->step = 1;
        $this->otp = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';

        session()->flash('success', 'Password changed successfully.');
    }

    public function backToStep1()
    {
        $this->step = 1;
        $this->otp = '';
    }

    public function render()
    {
        return view('livewire.frontend.my-profile')
            ->layout('layouts.dashboard');
    }
}
