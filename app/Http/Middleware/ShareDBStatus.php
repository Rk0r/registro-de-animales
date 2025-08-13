<?php

namespace App\Http\Middleware;

use Closure;

class ShareDBStatus
{
    public function handle($request, Closure $next)
    {
        $dbStatus = $this->checkDBConnection();
        view()->share('dbStatus', $dbStatus);
        
        return $next($request);
    }
    
    protected function checkDBConnection()
    {
        try {
            \DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}