<?php

namespace App\Services;

use App\DTOs\RequestResponseDTO;
use App\Models\RequestResponseLog;

class LoggerService
{

    public function storeRequestResponse(RequestResponseDTO $requestResponseDTO): void
    {
        RequestResponseLog::create([
            'method' => $requestResponseDTO->method,
            'session_id' => $requestResponseDTO->sessionId,
            'ip_address' => $requestResponseDTO->ipAddress,
            'address' => $requestResponseDTO->address,
            'parameters' => $requestResponseDTO->parameters,
            'request_time' => $requestResponseDTO->requestTime,
            'status_code' => $requestResponseDTO->statusCode,
            'error_message' => $requestResponseDTO->errorMessage,
            'response' => $requestResponseDTO->response,
            'service_work_time' => $requestResponseDTO->serviceWorkTime
        ]);

    }

}
