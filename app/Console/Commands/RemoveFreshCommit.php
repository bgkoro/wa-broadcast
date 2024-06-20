<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class RemoveFreshCommit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-fresh-commit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the "fresh_commit" entry from .ftp-deploy-sync-state.json';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filePath = base_path('.ftp-deploy-sync-state.json');

        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $data = json_decode($content, true);
            $dataCollection = new Collection($data['data']);
            $filtered = $dataCollection->whereNotIn('name', ['fresh_commit', 'log_file']);
            $data['data'] = $filtered->values()->all();
            $updatedContent = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents($filePath, $updatedContent);
            $this->info('The "fresh_commit" entry has been removed.');
        } else {
            $this->error('File .ftp-deploy-sync-state.json not found.');
        }
    }

}
