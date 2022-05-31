<?php

namespace Src\Scheduler;

use Illuminate\Database\Eloquent\Collection;
use Src\Models\Dev;
use Src\Models\Task;

class GreedyAlgorithm implements ScheduleAlgorithmInterface {

    public function assign($tasks, $devs): array
    {

        $tasks = $this->getTotalDurationAndHardness($tasks);

        $totalWork = array_sum($tasks->pluck('duration_by_hardness')->toarray());

        $totalWorkingPower = array_sum($devs->pluck('level')->toarray());

        $lowerBound = ceil ( $totalWork / $totalWorkingPower ) ;

        foreach ($devs as $dev ) {

            $dev->busy_hours = 0 ;

            $unassigned_tasks= $tasks->filter(function ($value) {
                return !$value->dev_id;
            })->sortBy('level');

            foreach ($unassigned_tasks as $task){

                $task->dev_id = $dev->id ;
                $task->save();

                $dev->busy_hours += $task->duration_by_hardness / $dev->level ;

                if($dev->busy_hours > $lowerBound ){
                    break;
                }


            }

            $dev->save();
        }

//        dd($devs->pluck('busy_hours')->toarray());


        return [];
    }


    /**
     *  task hardness multiply by its hardness
     *
     * @param $tasks
     * @return array
     */
    private function getTotalDurationAndHardness($tasks)
    {

        foreach ($tasks as $task ) {
            $task->dev_id = null ;
            $task->duration_by_hardness = $task->level * $task->duration ;
            $task->save();
        }

        return $tasks ;

    }


}
