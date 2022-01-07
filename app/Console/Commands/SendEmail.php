<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskNotification;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email to users for task`s deadline';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        Task::where('date',now()->addMinutes(30))->chunk(100, function($tasks) {
            foreach ($tasks as $task) {
                $task->user->notify(new TaskNotification($task));
            }
        });
    }
}
