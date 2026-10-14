<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Member\Member;
use App\Services\ValidationMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Site üyeliği: kayıt, giriş, çıkış ('member' guard).
 * Formlar hem başlıktaki pencerede (modals.blade.php) hem /uye/giris, /uye/kayit sayfalarında kullanılır;
 * hata bag'leri: memberLogin, memberRegister (pencere bunlara bakarak kendini yeniden açar).
 */
class MemberAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('front.account');
        }

        return view('front.pages.member.login');
    }

    public function showRegister()
    {
        if (Auth::guard('member')->check()) {
            return redirect()->route('front.account');
        }

        return view('front.pages.member.register');
    }

    public function login(Request $request)
    {
        $data = $request->validateWithBag('memberLogin', [
            'email'    => 'required|email|max:190',
            'password' => 'required|string|max:255',
        ], ValidationMessageService::getMessages('member_login'));

        $email = mb_strtolower(trim($data['email']));
        $throttleKey = 'member-login|' . $email . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()
                ->withErrors(['email' => "Çok fazla deneme yaptınız. Lütfen {$seconds} saniye sonra tekrar deneyin."], 'memberLogin')
                ->onlyInput('email');
        }

        $credentials = ['email' => $email, 'password' => $data['password'], 'is_active' => true];
        if (!Auth::guard('member')->attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);
            return back()
                ->withErrors(['email' => 'E-posta adresi veya şifre hatalı.'], 'memberLogin')
                ->onlyInput('email');
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        Auth::guard('member')->user()->forceFill(['last_login_at' => now()])->save();

        return redirect()->to($this->redirectTarget($request));
    }

    public function register(Request $request)
    {
        // Bot tuzağı: görünmeyen alan doluysa kayıt yapma
        if ($request->filled('website')) {
            return back();
        }

        $data = $request->validateWithBag('memberRegister', [
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|max:190|unique:members,email',
            'phone'    => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{7,30}$/'],
            'password' => 'required|string|min:8|max:255|confirmed',
            'privacy'  => 'accepted',
        ], ValidationMessageService::getMessages('member_register'));

        $member = Member::create([
            'name'                => $data['name'],
            'email'               => $data['email'],
            'phone'               => $data['phone'],
            'password'            => $data['password'],
            'privacy_accepted_at' => now(),
            'last_login_at'       => now(),
        ]);

        Auth::guard('member')->login($member);
        $request->session()->regenerate();

        return redirect()->route('front.account')
            ->with('account_status', 'Hoş geldiniz! Hesabınız oluşturuldu.');
    }

    public function logout(Request $request)
    {
        // Yalnız üye oturumu kapanır; session korunur (sepet ve aynı tarayıcıdaki panel oturumu etkilenmez)
        Auth::guard('member')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('front.home');
    }

    /**
     * Girişten sonra gidilecek adres: pencereden girildiyse aynı sayfa, /hesabim'e yönlendirilmiş ise oraya,
     * değilse Hesabım. Yalnız sitenin kendi adresleri kabul edilir.
     */
    private function redirectTarget(Request $request): string
    {
        $base = url('/');

        $intended = $request->session()->get('url.intended');
        if (is_string($intended) && str_starts_with($intended, $base) && str_contains($intended, '/hesabim')) {
            $request->session()->forget('url.intended');
            return $intended;
        }

        if ($request->input('from') === 'modal') {
            $previous = url()->previous();
            if (str_starts_with($previous, $base . '/') && !str_contains($previous, '/uye/')) {
                return $previous;
            }
        }

        return route('front.account');
    }
}
