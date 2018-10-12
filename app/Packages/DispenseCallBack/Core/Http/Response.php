<?php
namespace App\Packages\DispenseCallBack\Core\Http;

class Response
{
    private $body;
    private $status;

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status  = $status;
    }

    public function isSuccess()
    {
        if (200 <= $this->status && 300 > $this->status) {
            return true;
        }

        return false;
    }

    public function getMessage(){
        $response = $this->body;
        $response = json_decode($response,true);
        return isset($response['message'])?$response['message']:'';
    }
}
