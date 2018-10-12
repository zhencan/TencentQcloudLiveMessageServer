<?php

namespace App\Logic;

use App\Log\DealLog;
require_once __DIR__ . '/../../app/Packages/DealLog/DealLog.php';

use App\Packages\DispenseCallBack\Dispense\Dispense;
require_once __DIR__ . '/../Packages/DispenseCallBack/Dispense/Dispense.php';

class zhongyijiaoyuLogic
{
    public static function liveMessage($data)
    {
        $info = $data['info'];
        $config = $data['config'];
        $dispense_obj = new Dispense($config['live_require_url']);
        $res_data = $dispense_obj->dispenseCallBackMessage($info);

        return $res_data;
    }

    public static function playbackMessage($data)
    {
        $info = $data['info'];
        $config = $data['config'];

        $dispense_obj = new Dispense($config['playback_require_url']);
        $dispense_obj->dispenseCallBackMessage($info);
    }
}