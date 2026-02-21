<?php

namespace App\Livewire\Frontend;

use App\Models\User;
use Livewire\Component;
use App\Mail\VerifyOtpMail;
use App\Models\EmailOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class AuthModal extends Component
{

    public bool $open = false;

    // screens: register | login | otp
    public string $screen = 'register';

    // register fields
    public string $name = '';
    public string $email = '';
    public ?string $phone = null;
    public string $password = '';
    public string $password_confirmation = '';

    // login fields
    public string $login_email = '';
    public string $login_password = '';

    // otp fields
    public string $otp = '';
    public string $otp_email = ''; // the email we're verifying
    public ?int $pending_user_id = null;


    // Forgot password modal state
    public bool $showForgot = false;
    public int $forgotStep = 1; // 1=email, 2=otp, 3=new password

    public string $forgot_email = '';
    public string $forgot_otp = '';
    public string $forgot_password = '';
    public string $forgot_password_confirmation = '';

    public ?int $forgot_resend_available_at = null;
    public int $forgot_cooldown_remaining = 0;
    protected $listeners = ['open-auth-modal' => 'openModal'];

    public function openModal(): void
    {
        $this->resetValidation();
        $this->open = true;
        $this->screen = 'register';
        $this->otp = '';
        $this->pending_user_id = null;
        $this->otp_email = '';
    }

    public function closeModal(): void
    {
        $this->open = false;
    }

    public function goRegister(): void
    {
        $this->resetValidation();
        $this->screen = 'register';
    }

    public function goLogin(): void
    {
        $this->resetValidation();
        $this->screen = 'login';
    }

    private function sendOtpTo(string $email): void
    {
        $code = (string) random_int(100000, 999999);

        // invalidate previous unused codes
        EmailOtp::where('email', $email)
            ->where('purpose', 'verify_email')
            ->whereNull('used_at')
            ->update(['used_at' => now()]);

        EmailOtp::create([
            'email' => $email,
            'purpose' => 'verify_email',
            'code_hash' => bcrypt($code),
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($email)->send(new VerifyOtpMail($code));
    }

    public function register(): void
    {
        $this->validate([
            'name' => 'required|min:2|max:80',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|max:30',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => bcrypt($this->password),
            'user_status' => 'not_verified',
        ]);

        $this->pending_user_id = $user->id;
        $this->otp_email = $user->email;

        $this->sendOtpTo($user->email);

        $this->screen = 'otp';
        $this->otp = '';
    }

    public function login(): void
    {
        $this->validate([
            'login_email' => 'required|email',
            'login_password' => 'required|min:1',
        ]);

        if (!auth()->attempt(['email' => $this->login_email, 'password' => $this->login_password], true)) {
            $this->addError('login_email', 'Invalid email or password.');
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        // If not verified → require OTP
        if (($user->user_status ?? 'not_verified') !== 'verified') {
            $this->otp_email = $user->email;
            $this->pending_user_id = $user->id;

            $this->sendOtpTo($user->email);

            $this->screen = 'otp';
            $this->otp = '';
            return;
        }

        // Verified → success
        $this->open = false;
        $this->dispatch('auth-success');
    }

    public function resendOtp(): void
    {
        if (!$this->otp_email) {
            $this->addError('otp', 'No email to resend OTP.');
            return;
        }
        $this->sendOtpTo($this->otp_email);
    }

    public function verifyOtp(): void
    {
        $this->validate([
            'otp_email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $row = EmailOtp::where('email', $this->otp_email)
            ->where('purpose', 'verify_email')
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

        // Mark user verified and login
        $user = $this->pending_user_id ? User::find($this->pending_user_id) : User::where('email', $this->otp_email)->first();

        if (!$user) {
            $this->addError('otp', 'User not found.');
            return;
        }

        $user->update(['user_status' => 'verified']);

        auth()->login($user, true);

        $this->open = false;
        $this->dispatch('auth-success');
    }
    public function openForgot(): void
{
    $this->resetValidation();
    $this->showForgot = true;
    $this->forgotStep = 1;
}
public function sendForgotOtp(): void
{
    $this->validate([
        'forgot_email' => 'required|email|exists:users,email',
    ]);

    $code = (string) random_int(100000, 999999);

    EmailOtp::where('email', $this->forgot_email)
        ->where('purpose', 'forgot_password')
        ->whereNull('used_at')
        ->update(['used_at' => now()]);

    EmailOtp::create([
        'email' => $this->forgot_email,
        'purpose' => 'forgot_password',
        'code_hash' => bcrypt($code),
        'expires_at' => now()->addMinutes(10),
    ]);

    Mail::to($this->forgot_email)->send(new VerifyOtpMail($code));

    $this->forgotStep = 2;
}
public function verifyForgotOtp(): void
{
    $this->validate([
        'forgot_otp' => 'required|digits:6',
    ]);

    $row = EmailOtp::where('email', $this->forgot_email)
        ->where('purpose', 'forgot_password')
        ->whereNull('used_at')
        ->latest()
        ->first();

    if (!$row || now()->greaterThan($row->expires_at)) {
        $this->addError('forgot_otp', 'OTP expired. Please resend.');
        return;
    }

    if (!Hash::check($this->forgot_otp, $row->code_hash)) {
        $this->addError('forgot_otp', 'Invalid OTP.');
        return;
    }

    $row->update(['used_at' => now()]);

    $this->forgotStep = 3;
}
public function resetForgotPassword(): void
{
    $this->validate([
        'forgot_password' => 'required|min:6|confirmed',
    ]);

    $user = User::where('email', $this->forgot_email)->first();

    if (!$user) {
        $this->addError('forgot_email', 'User not found.');
        return;
    }

    $user->update([
        'password' => bcrypt($this->forgot_password),
    ]);

    $this->showForgot = false;
    $this->screen = 'login';
}

    public function render()
    {
        return view('livewire.frontend.auth-modal');
    }
}
