<?php

namespace App\Packages\DispenseCallBack\Core\Http;

use App\Packages\DispenseCallBack\Core\Http\Request;
require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/Response.php';

class HttpClient
{
    public static $connectTimeout = 100000; // 10 second
    public static $readTimeout = 100000; // 10 second

    public static function curl(Request $request)
    {
        $httpMethod = $request->getMethod();
        $url = $request->getRequestUrl();
        $postFields = $request->getParams();
        $headers = $request->getHeaders();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
        if (defined('ENABLE_HTTP_PROXY')) {  //如果有设置http代理
            curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_PROXY, HTTP_PROXY_IP);
            curl_setopt($ch, CURLOPT_PROXYPORT, HTTP_PROXY_PORT);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($httpMethod == 'POST' || $httpMethod == 'PUT'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        }
        if (self::$readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, self::$readTimeout);
        }
        if (self::$connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$connectTimeout);
        }
        //https request
        if (strlen($url) > 5 && strtolower(substr($url, 0, 5)) == "https") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_array($headers) && 0 < count($headers)) {
            $httpHeaders = self::getHttpHearders($headers);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeaders);
        }
        $httpResponse = new Response();
        $httpResponse->setBody(curl_exec($ch));
        $httpResponse->setStatus(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        if (curl_errno($ch)) {
            throw new \Exception('pingqu-cloud-server is unavailable');
        }
        curl_close($ch);

        return $httpResponse;
    }


    public static function getHttpHearders($headers)
    {
        $httpHeader = array();
        foreach ($headers as $key => $value) {
            array_push($httpHeader, $key.":".$value);
        }

        return $httpHeader;
    }

}
