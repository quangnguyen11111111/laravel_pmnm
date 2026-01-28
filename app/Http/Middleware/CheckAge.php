<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('age','age/*')) {
            return $next($request);
        }
 $age = session('age');
    
    if (!is_numeric($age)) {
        return redirect()->route('showForm')->with('error', 'Vui lòng nhập tuổi hợp lệ.');
    }
    $age = (int) $age;;
      if($age < 18){
        return redirect()->route('showForm')->with('error', 'Bạn phải đủ 18 tuổi trở lên để truy cập trang này.');
      }
        return $next($request);
    }
}
