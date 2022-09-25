<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Pkboom\FileWatcher\FileWatcher;
use React\EventLoop\Loop;

class PickCommand extends Command
{
    protected $signature = 'pick';

    public $pickFile;

    public function __construct()
    {
        parent::__construct();

        $this->pickFile = Config::get('pick.file');
    }

      public function handle()
      {
          $this->prepareFiles();

          $this->info('Running pick ...');

          $this->runPick();
      }

      public function prepareFiles()
      {
          if (File::missing($this->pickFile)) {
              return touch($this->pickFile);
          }
      }

      public function runPick()
      {
          $watcher = FileWatcher::create($this->pickFile);

          Loop::addPeriodicTimer(1, function () use ($watcher) {
              $watcher->find()->whenChanged(function () {
                  $code = file_get_contents($this->pickFile);

                  logger($code);
              });
          });
      }
}
