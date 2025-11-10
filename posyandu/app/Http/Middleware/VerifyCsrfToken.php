<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
    
    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        $token = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');
        
        if (!$token) {
            return false;
        }
        
        $sessionToken = $request->session()->token();
        
        // Jika token tidak match, coba regenerate dan cek lagi
        if (!hash_equals($sessionToken, $token)) {
            // Regenerate token untuk request berikutnya
            $request->session()->regenerateToken();
            return false;
        }
        
        return true;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Untuk route logout, berikan sedikit toleransi
        if ($request->routeIs('logout')) {
            try {
                return parent::handle($request, $next);
            } catch (\Illuminate\Session\TokenMismatchException $e) {
                // Jika token mismatch, regenerate dan redirect ke login dengan pesan
                $request->session()->regenerateToken();
                return redirect()->route('login')
                    ->with('error', 'Session expired. Silakan login kembali.');
            }
        }
        
        return parent::handle($request, $next);
    }
}

