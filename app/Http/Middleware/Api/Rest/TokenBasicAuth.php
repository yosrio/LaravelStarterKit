<?php

namespace App\Http\Middleware\Api\Rest;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Integration;

class TokenBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        if (!array_key_exists('authorization', $request->header())) {
            return response()->json(
                [
                    'error' => [
                        'message' => 'Unauthorized'
                    ]
                ],
                401
            );
        }

        $token = $request->header('Authorization');
        if (!$this->isValidToken($token)) {
            return response()->json(
                [
                    'error' => [
                        'message' => 'Wrong input token'
                    ]
                ],
                401
            );
        }

        return $next($request);
    }
    
    /**
     * isValidToken
     *
     * @param string $token
     * @return boolean
     */
    private function isValidToken($token)
    {
        $integrationToken = $this->getIntegrationToken($token);
        return $token === $integrationToken;
    }
    
    /**
     * getIntegrationToken
     *
     * @param string $token
     * @return string
     */
    private function getIntegrationToken($token)
    {
        $integrationToken = Integration::where('token', $token)->first('token');
        return $integrationToken->token ?? '';
    }
}
