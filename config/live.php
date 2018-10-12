<?php

return array(

    // 腾讯appid
    'qcloup_appid' => 'xxx',
    // 腾讯key
    'qcloup_key' => 'xxx',
    // 腾讯直播商业id
    'qcloup_bizid' => 'xxx',

    // 回调分配应用
    'application' => array(
        0 => array(
            // 说明直播名称
            'app_name_cn' => 'xx直播',
            // 说明直播名称
            'app_name' => 'aaa',
            // 生成逻辑类名称
            'logic_name' => 'Aaa',
            'sdkappid' => 'xxx',
            'live_require_url' => 'http://path',
            'playback_require_url' => 'http://path',
        ),
        1 => array(
            'app_name_cn' => 'xx直播',
            'app_name' => 'bbb',
            'logic_name' => 'Bbb',
            'sdkappid' => 'xxx',
            'live_require_url' => 'http://path',
            'playback_require_url' => 'http://path',
        ),
        // ......
    ),

);