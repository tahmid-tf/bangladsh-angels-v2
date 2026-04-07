<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URIs excluded from CSRF (payment gateways POST back without tokens).
     *
     * @var array<int, string>
     */
    protected $except = [
        'upgrade/success',
        'upgrade/fail',
        'payment/aamarpay/callback',
    ];
}
