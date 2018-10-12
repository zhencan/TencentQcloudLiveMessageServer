<?php
/**
 * Created by PhpStorm.
 * User: yuelin
 * Date: 2018/2/24
 * Time: 下午6:42
 */

namespace App\Packages\DispenseCallBack\Core\Http;

class Request
{
    private $params = [];

    private $headers = [];

    private $version = '0.0.1';

    private $url;

    private $method = 'GET';

    private $query;

    private static $methodArr = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    public function __construct()
    {

    }

    public function setHeader(array $headers = []){
        $this->headers = $headers;
    }

    public function setParams(array $params = []){
        $this->params = $params;
    }

    public function setRequestUrl($url){
        $this->url = $url;
    }

    public function setMethod($method){
        if (!in_array($method,self::$methodArr)){
            throw new \Exception('请求方式必须为\'GET\', \'HEAD\', \'POST\', \'PUT\', \'PATCH\', \'DELETE\', \'OPTIONS\'中一种');
        }
        $this->method = $method;
    }

    public function setQuery(array $query = []){
        foreach ($query as $key => $item) {
            $this->query.=$key.'='.$item.'&';
        }
        $this->query = trim($this->query, "&");
    }

    public function getQuery() {
        return $this->query;
    }

    public function getVersion(){
        return $this->version;
    }

    public function getRequestUrl(){
        if (empty($this->url)){
            throw new \Exception('请求url不能为空');
        }
        return $this->url.'?'.$this->query;
    }

    public function getHeaders(){
        return $this->headers;
    }

    public function getParams(){
        return $this->params;
    }

    public function getMethod(){
        return $this->method;
    }
}