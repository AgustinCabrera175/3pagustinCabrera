<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;

class Prueba
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $navegador = $request->header('User-Agent');
        $userId = Auth::id();
        $accion = $this->getAction($request);

        DB::table('logs')->insert([
            'users_id' => $userId,
            'accion' => $accion,
            'ip' => $ip,
            'navegador' => $navegador,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $next($request);
    }
    private function getAction(Request $request)
    {
        $method = $request->method();

        switch ($method) {
            case 'POST':
                return 'crear estudiante';
            case 'PUT':
                return 'editar estudiante';
            case 'DELETE':
                return 'borrar estudiante';
            default:
                return 'recarga de pagina';
        }
    }
}
