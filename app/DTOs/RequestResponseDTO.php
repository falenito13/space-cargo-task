<?php

namespace App\DTOs;

class RequestResponseDTO
{

    public string $method, $sessionId, $ipAddress, $address,$requestTime,$serviceWorkTime;
    public string|null $errorMessage;
    public int $statusCode;
    public array $parameters, $response;

    public function __construct(
        string $method, string $sessionId, string $ipAddress, string $address, string|null $errorMessage,
        string $requestTime, string $serviceWorkTime, int $statusCode, array $parameters, array $response
    )
    {
        $this->method = $method;
        $this->sessionId = $sessionId;
        $this->ipAddress = $ipAddress;
        $this->address = $address;
        $this->errorMessage = $errorMessage;
        $this->requestTime = $requestTime;
        $this->serviceWorkTime = $serviceWorkTime;
        $this->statusCode = $statusCode;
        $this->parameters = $parameters;
        $this->response = $response;
    }


}
