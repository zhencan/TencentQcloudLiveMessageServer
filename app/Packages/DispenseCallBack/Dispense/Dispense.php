<?php

namespace App\Packages\DispenseCallBack\Dispense;

use App\Log\DealLog;
require_once __DIR__ . '/../../DealLog/DealLog.php';

use App\Packages\DispenseCallBack\Core\Http\HttpClient;
use App\Packages\DispenseCallBack\Core\Http\Request;
require_once __DIR__ . '/../Core/Http/HttpClient.php';
require_once __DIR__ . '/../Core/Http/Request.php';

class Dispense
{
    private static $KEY = 'TpCwx33D5vagXCmK';
    private $request_url;
    private $public_params = [];
    private $request;

    public function __construct($request_url)
    {
        $this->request_url = $request_url;
//        $this->public_params['t'] = $t = time();
//        $this->public_params['sign'] = md5(self::$KEY . $t);
        $this->request = new Request();
        $this->request->setRequestUrl($this->request_url);
    }

    /**
     * 分发回调消息
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function dispenseCallBackMessage($data)
    {
        $params = $data;
        $params = array_merge($params, $this->public_params);
        $this->request->setParams($params);
        $this->request->setMethod('POST');
        $result = HttpClient::curl($this->request);
        if (empty(json_decode($result->getBody()))) {
            throw new \Exception($result->getBody());
        } else {
            return json_decode($result->getBody(), true);
        }
    }
}