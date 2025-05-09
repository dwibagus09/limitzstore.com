<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => [
                'data-ajax',
                '/daftar-harga/ajax',
                '/admin/produk/update-ajax/[0-9]+',
                '/admin/produk/ajax-load-profit-setting',
                '/admin/pesanan/detail/[0-9]+',
                '/admin/pesanan/check/[0-9]+',
                '/admin/pesanan/ajax-load-data',
                '/admin/pesanan/ajax-load-history',
                '/admin/pesanan/ajax-load-refund',
                '/user/daftar-harga/ajax',
                '/user/send-balance',
                '/games/order/.+/.+',
                '/games/.+',
                '/sistem/callback/.+',
                '/sistem/callback_digiflazz',
                '/sistem/callback_vocagame',
                '/sistem/callback_gamepoint',
                '/sistem/refund_balance',
                '/sistem/eod',
                '/admin/config/click',
                '/payment/check/list-order',
                '/admin/produk/sort',
                '/proxy/check-account'
            ]
        ]
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
