<?php

namespace App\core;

class Response
{
    private $content;
    private $statusCode;
    private $headers;

    public function __construct($content, $statusCode = 200, $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function toResponse()
    {
        http_response_code($this->statusCode);

        $this->headers = (empty($this->headers)) ? $_SERVER['HTTP_ACCEPT'] : 'application/json';
        if ($this->headers == "application/json" and (gettype($this->content) == "array" or $this->content instanceof \JsonSerializable)) {
            echo json_encode($this->content);
            die();
        }

        echo $this->content;
        die();
    }
}