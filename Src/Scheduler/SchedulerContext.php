<?php

namespace Src\Scheduler;

use Src\Models\Dev;
use Src\Models\Task;

class  SchedulerContext {

    private $strategy;

    public function setStrategy(string $strategy): static
    {
        $this->strategy = $this->makeStrategy($strategy);

        return $this;
    }

    public function doSchedule(): void
    {
        if (!$this->strategy) {
            abort(401 , 'strategy for schedule class is not set ');
        }

        $tasks = Task::all();

        $devs = Dev::all();

        $this->strategy->assign($tasks , $devs);


    }

    private function makeStrategy (string $name) : ScheduleAlgorithmInterface
    {
        switch ($name){
            case 'greedy':
                return new GreedyAlgorithm();
            default:
                // default strategy
        }
    }
}
