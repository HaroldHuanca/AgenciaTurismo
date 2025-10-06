<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
// Force loading .env.testing
$dotEnv = '.env.testing';
if (file_exists(__DIR__ . '/../' . $dotEnv)) {
    $app->loadEnvironmentFrom($dotEnv);
}
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo "env DB_CONNECTION=" . env('DB_CONNECTION') . PHP_EOL;
echo "config default=" . config('database.default') . PHP_EOL;
$connections = config('database.connections');
if (isset($connections[config('database.default')])) {
    echo "driver=" . $connections[config('database.default')]['driver'] . PHP_EOL;
}
