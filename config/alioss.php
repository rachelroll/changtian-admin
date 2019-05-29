<?php
return [
    'OSS_ACCESS_ID' => env('ACCESS_ID',''),
    'OSS_ACCESS_KEY' => env('ACCESS_KEY',''),
    'OSS_ENDPOINT' => env('END_POINT','http://oss-cn-beijing.aliyuncs.com'),
    'OSS_BUCKET' => env('BUCKET',''),
    'OSS_HOST' => env('CDN_DOMAIN','//oss-cn-beijing.aliyuncs.com'),
    //前台显示域名
    'OSS_URL' => env('CDN_DOMAIN','//oss-cn-beijing.aliyuncs.com'), // CDN域名，没有CDN就和OSS_HOST一致即可
];
