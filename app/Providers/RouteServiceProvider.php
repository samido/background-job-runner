<?php

public function boot(): void
{
    $this->routes(function () {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    });
}
