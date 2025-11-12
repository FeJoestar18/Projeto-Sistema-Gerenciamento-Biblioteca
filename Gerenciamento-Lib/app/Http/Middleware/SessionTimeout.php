<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    /**
     * RN-009: Expirar sessão após 30 minutos de inatividade
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = $request->session()->get('last_activity_time');
            $timeout = 30 * 60; // 30 minutos em segundos

            if ($lastActivity && (time() - $lastActivity > $timeout)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('message', 'Sua sessão expirou por inatividade. Por favor, faça login novamente.');
            }

            $request->session()->put('last_activity_time', time());
        }

        return $next($request);
    }
}
