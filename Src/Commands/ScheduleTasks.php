<?php

namespace Src\Commands;

use Illuminate\Console\Command;
use Src\Scheduler\GreedyAlgorithm;
use Src\Scheduler\SchedulerContext;

class ScheduleTasks extends Command
{

    public function __construct(
        private $taskService = new \Src\Providers\TaskService,
        private $scheduler = new \Src\Scheduler\SchedulerContext,
    )
    {

        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks {strategy}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        // get tasks
        $this->line('getting tasks from source');

        $taskModels = $this->taskService->getTasks();

        $this->newLine(1); // ---


        // write task in DB
        $this->line('saving tasks in database');

        $savedTasks = $this->taskService->saveTasks($taskModels);

        $this->newLine(1); // ---


        // schedule task
        $this->line('running schedule algorithm');

        $scheduler = new SchedulerContext();

        $scheduler->setStrategy('greedy');
        $scheduler->doSchedule();


        $reasult = $this->scheduler->setStrategy('greedy')
        ->doSchedule();

        $this->newLine(1); // ---


        // ---

        // say thanks.
        $this->info('The schedule was successful!');

        return 0;
    }
}
