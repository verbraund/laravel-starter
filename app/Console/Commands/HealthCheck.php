<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

#[Signature('health:check')]
#[Description('Check application health')]
class HealthCheck extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        return (int)in_array(false, [
            $this->checkAppKey(),
            $this->checkDebugMode(),
            $this->checkDiskSpace(),
            $this->checkWritePermissions(),
            $this->checkCache(),
            $this->checkDatabase()
        ], true);
    }

    protected function checkAppKey(): bool
    {
        return $this->check('App Key', function(){
            return config('app.key') !== null;
        });
    }

    protected function checkDebugMode(): bool
    {
        return $this->check('Debug mode', function(){
            return !config('app.debug');
        });
    }

    protected function checkDiskSpace()
    {
        return $this->check('Disc space', function(){
            $criticalPercent = 5;
            $criticalMB = 1024; //1Gb

            $path = storage_path();
            $freeBytes = disk_free_space($path);
            $totalBytes = disk_total_space($path);

            $freeMB  = round($freeBytes / 1024 / 1024, 2);
            $freePercent = round(($freeBytes / $totalBytes) * 100, 2);

            return !(($freePercent < $criticalPercent || $freeMB < $criticalMB));
        });
    }

    protected function checkWritePermissions(): bool
    {
        return $this->check('Write permissions', function(){
            $dirs = [
                storage_path(),
                storage_path('logs'),
                storage_path('framework'),
                base_path('bootstrap/cache'),
            ];
            foreach ($dirs as $dir) {
                if(!is_writable($dir)) {
                    throw new \Exception("$dir is not writable");
                }
            }
            return true;
        });
    }

    protected function checkCache(): bool
    {
        return $this->check('Cache', function(){
            Cache::put('health_check', 'ok', now()->addSeconds(10));;
            return
                Cache::get('health_check') === 'ok';
        });
    }

    protected function checkDatabase(): bool
    {
        return $this->check('Database', function(){
            return DB::connection()->getPdo() !== null;
        });
    }

    protected function check(string $name, callable $callback): bool
    {
        try{
            if ($callback()) {
                return $this->success($name);
            }
            return $this->failed($name);
        }catch (\Throwable $e){
            return $this->failed($name, $e->getMessage());
        }
    }

    protected function success(string $name): bool
    {
        $this->info("✔ $name OK");
        return true;
    }

    protected function failed(string $name, ?string $message = null): bool
    {
        $this->error("✖ $name FAIL");
        if($message){
            $this->error($message);
        }
        return false;
    }
}
