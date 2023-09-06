<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Livewire\FileUploadConfiguration;

class CleanLivewireTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:LivewireTemp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans Livewire temporary storage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $storage = FileUploadConfiguration::storage();

        foreach ($storage->allFiles(FileUploadConfiguration::path()) as $filePathname) {
            // On busy websites, this cleanup code can run in multiple threads causing part of the output
            // of allFiles() to have already been deleted by another thread.
            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subDay()->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
        Log::info("Livewire temporary storage has been purged.");
    }
}
