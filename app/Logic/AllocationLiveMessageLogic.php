<?php

namespace App\Logic;

use App\Log\DealLog;
require_once __DIR__ . '/../../app/Packages/DealLog/DealLog.php';

require_once __DIR__ . '/../Logic/AaaLogic.php';
require_once __DIR__ . '/../Logic/BbbLogic.php';

class AllocationLiveMessageLogic
{
    public static function index($data)
    {
        // 获取配置数据
        $config_data = CONFIG_LIVE;

        // 分配消息
        $app_arr = $config_data['application'];
        $stream_param_temp = explode('&', $data['stream_param']);
        $stream_param = explode('=', $stream_param_temp[4]);
        $sdkappid = $stream_param[1];
        foreach ($app_arr as $app) {
            if ($app['sdkappid'] == $sdkappid) {
                $ctrl_name = 'App\Logic\\' . $app['logic_name'] . 'Logic';
                $ctrl_name::liveMessage(['info' => $data, 'config' => $app]);
            }
        }
    }
}