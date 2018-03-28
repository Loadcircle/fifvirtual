<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'code' => '98',
    'patterns' => [
        'national' => [
            'general' => '/^[2-6]\\d{4,9}|9(?:[1-4]\\d{8}|9\\d{2,8})|[178]\\d{9}$/',
            'fixed' => '/^2(?:1[2-9]\\d{2,7}|51\\d{3,7})|(?:241|3(?:11|51)|441|5[14]1)\\d{4,7}|(?:3(?:34|41)|6(?:11|52))\\d{6,7}|(?:1(?:[134589][12]|[27][1-4])|2(?:2[189]|[389][12]|42|5[256]|6[1-59]|7[34])|3(?:12|2[1-4]|3[125]|4[24-9]|5[23]|[6-9][12])|4(?:[135-9][12]|2[1-467]|4[2-4])|5(?:12|2[89]|3[1-5]|4[2-8]|[5-7][12]|8[1245])|6(?:12|[347-9][12]|51|6[1-6])|7(?:[13589][12]|2[1289]|4[1-4]|6[1-6]|7[1-3])|8(?:[145][12]|3[124578]|6[1256]|7[1245]))\\d{7}$/',
            'mobile' => '/^9(?:1(?:[039]\\d|[16][1-35-9]|2[1-8]|4[013-9]|[57][1-9]|8[13-9])|2[01]\\d|3(?:[035-9]\\d|13|2[1-579]|47))\\d{6}$/',
            'pager' => '/^943[24678]\\d{6}$/',
            'voip' => '/^993[12]\\d{6}$/',
            'uan' => '/^9990\\d{0,6}$/',
            'emergency' => '/^1(?:1[025]|25)$/',
        ],
        'possible' => [
            'general' => '/^\\d{4,10}$/',
            'fixed' => '/^\\d{5,10}$/',
            'mobile' => '/^\\d{10}$/',
            'pager' => '/^\\d{10}$/',
            'voip' => '/^\\d{10}$/',
            'emergency' => '/^\\d{3}$/',
        ],
    ],
];
