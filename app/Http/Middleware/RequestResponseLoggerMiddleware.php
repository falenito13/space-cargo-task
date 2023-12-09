<?php

namespace App\Http\Middleware;

use App\DTOs\RequestResponseDTO;
use App\Services\LoggerService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestResponseLoggerMiddleware
{

    private static array $logData = [];

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $parameters = $request->all();
        if ($request->getRequestUri() === '/api/login') {
            $parameters['password'] = str_repeat('*', strlen($parameters['password']));
        }
        static::$logData['method'] = $request->getMethod();
        static::$logData['session_id'] = $request->getSession()->getId();
        static::$logData['ip_address'] = $request->getClientIp();
        static::$logData['address'] = $request->getRequestUri();
        static::$logData['parameters'] = $parameters;
        static::$logData['request_time'] = now()->format('Y-m-d H:i:s');
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $loggerService = new LoggerService();
        static::$logData['status_code'] = $response->getStatusCode();

        if (!json_decode($response->getContent())->success) {
            static::$logData['error_message'] = !$response->getContent()['message'];
        }
        static::$logData['response'] = json_decode($response->getContent(),true);
        static::$logData['service_work_time'] = now()->diffInMilliseconds(static::$logData['request_time']);
        $requestResponseDTO = new RequestResponseDTO(
            method: static::$logData['method'], sessionId: static::$logData['session_id'], ipAddress: static::$logData['ip_address'],
            address: static::$logData['address'], errorMessage: static::$logData['error_message'] ?? null,
            requestTime: static::$logData['request_time'], serviceWorkTime: static::$logData['service_work_time'],
            statusCode: static::$logData['status_code'], parameters: static::$logData['parameters'], response: static::$logData['response']
        );
        $loggerService->storeRequestResponse($requestResponseDTO);
    }
}
