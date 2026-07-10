<?php

use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\URL;

afterEach(function (): void {
    URL::forceRootUrl(null);
    URL::forceScheme(null);
});

test('production urls are generated from the configured app url', function () {
    $this->app->detectEnvironment(fn (): string => 'production');

    config(['app.url' => 'https://owl.clickwire.io']);

    (new AppServiceProvider($this->app))->boot();

    expect(URL::to('/dashboard'))->toBe('https://owl.clickwire.io/dashboard')
        ->and(asset('build/assets/app.css'))->toBe('https://owl.clickwire.io/build/assets/app.css');
});
