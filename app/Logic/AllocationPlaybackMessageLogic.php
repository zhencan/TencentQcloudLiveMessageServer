<?php

namespace App\Logic;

use App\Log\DealLog;
require_once __DIR__ . '/../../app/Packages/DealLog/DealLog.php';

require_once __DIR__ . '/../Logic/AaaLogic.php';
require_once __DIR__ . '/../Logic/BbbLogic.php';

class AllocationPlaybackMessageLogic
{
    public static function index($data)
    {
        // 获取配置数据
        $config_data = CONFIG_LIVE;

        // 分配消息
        $app_arr = $config_data['application'];
        foreach ($app_arr as $app) {
            $ctrl_name = 'App\Logic\\' . $app['logic_name'] . 'Logic';
            $ctrl_name::playbackMessage(['info' => $data, 'config' => $app]);
        }
    }
}