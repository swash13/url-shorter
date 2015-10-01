<?php

return [
    'index' => 'site/index',
    'cleanup' => 'site/cleanup',
    'url-create' => 'site/url-create',
    '<url:.{3,8}>/view' => 'site/url-view',
    '<url:.{3,8}>/stat' => 'site/stat',
    '<url:.{3,8}>' => 'site/url-redirect'
];