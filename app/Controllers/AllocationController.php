<?php

namespace App\Controllers;

use App\Log\DealLog;
require_once __DIR__ . '/../../app/Packages/DealLog/DealLog.php';

require_once __DIR__ . '/../Logic/AllocationLiveMessageLogic.php';
require_once __DIR__ . '/../Logic/AllocationPlaybackMessageLogic.php';

class AllocationController
{
    public function index($data)
    {
        $config_data = CONFIG_LIVE;

        // 判断回播类型是不是 0推流 1断流 100新录制文件 200新截图文件
        if (isset($data['event_type']) && ($data['event_type'] == 0 || $data['event_type'] == 1 || $data['event_type'] == 100 || $data['event_type'] == 200))
        if (isset($data['appid']) && $data['appid'] == $config_data['qcloup_appid']) {
            \App\Logic\AllocationLiveMessageLogic::index($data);
        }

        // 腾讯回调数据无法判断属于哪个直播应用,所以都进行分配
        if (isset($data['eventType']) && $data['eventType'] == 'ConcatComplete') {
            \App\Logic\AllocationPlaybackMessageLogic::index($data);
        }
    }
}