<?php

define('API_SECRET_PARAM', 'api_url_secret');
define('API_SECRET_CODE',  '0A1B0c2D0e3F0G');

return [
    'URL_ROUTE_RULES' => [
        // 易码旧数据转移脚本
        ['wechat/index$', 'wechat/index',  API_SECRET_PARAM.'='.API_SECRET_CODE, ['method' => 'get']],
        ['wechat$', 'wechat/getUserOpenId',  API_SECRET_PARAM.'='.API_SECRET_CODE, ['method' => 'get']],
    ]
];
