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
        '*payment/aamarpay/callback',
    ];

    /**
     * AamarPay may POST from an external origin; path patterns can miss subdirectory installs.
     * Route matching is set before the middleware stack runs, so routeIs is reliable.
     */
    protected function inExceptArray($request): bool
    {
        if ($request->routeIs('payment.aamarpay.callback')) {
            return true;
        }

        $path = trim($request->path(), '/');
        if (str_ends_with($path, 'payment/aamarpay/callback')) {
            return true;
        }

        return parent::inExceptArray($request);
    }
}
