<?php

// 导入日志
use App\Log\DealLog;
require_once __DIR__ . '/../app/Packages/DealLog/DealLog.php';

define('CONFIG_LIVE', require(__DIR__ . '/../config/live.php'));

use App\Controllers\AllocationController;
require_once __DIR__ . '/../app/Controllers/AllocationController.php';

// 回调数据
$info = json_decode(file_get_contents('php://input'), true);

$drive = new AllocationController();

/*
$info = [
    "app"=>"25650.livepush.myqcloud.com",
    "appid"=>1256889456,
    "appname"=>"live",
    "channel_id"=>"25650_ff75e9a8f026ecde57b11d5d1c23387d",
    "errcode"=>1,
    "errmsg"=>"recv rtmp deleteStream",
    "event_time"=>1534929358,
    "event_type"=>0,
    "idc_id"=>32,
    "node"=>"115.159.255.105",
    "push_duration"=>"113224",
    "sequence"=>"477771218361482575",
    "set_id"=>2,
    "sign"=>"910a3fa48ebc950984fca4f2e137f570",
    "stream_id"=>"25650_5bff354d5b757c2325d79a8b9b279c0f",
    "stream_param"=>"txSecret=838ea6e96295b5dc27fe13b66720e066&txTime=6e07415c&from=interactive&client_business_type=0&sdkappid=1400126503&sdkapptype=1&groupid=1254495185&userid=MTEzNjgwMzI2MDYx&ts=5b7d27c4&cliRecoId=0",
    "t"=>1534930380,
    "user_ip"=>"121.51.129.39"
];*/
/*
$info = [
    "version"=> "4.0",
    "eventType"=> "ConcatComplete",
    "data"=> [
    "vodTaskId"=> "Concat-1edb7eb88a599d05abe451cfc541cfbd",
        "fileInfo"=> [
            [
                "fileType"=> "m3u8",
                "status"=> 0,
                "message"=> "",
                "fileId"=> "14508071098244931831",
                "fileUrl"=> "http=>//125xx.vod2.myqcloud.com/vod125xx/14508071098244931831/playlist.f6.m3u8"
            ],
            [
                "fileType"=> "mp4",
                "status"=> 0,
                "message"=> "",
                "fileId"=> "14508071098244929440",
                "fileUrl"=> "http=>//125xx.vod2.myqcloud.com/vod125xx/14508071098244929440/f0.mp4"
            ]
        ]
    ]
];*/

DealLog::info($info);

$drive->index($info);
