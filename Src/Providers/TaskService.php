<?php

namespace Src\Providers;

use Src\Models\Task;

class TaskService {

    private function list():array{
        return [
            /*
             * `providers and their classes`...
             */
            Provider1::class,
            Provider2::class,
        ];
    }

    public function getTasks(): array
    {
        $taskModels = [];

        foreach($this->list() as $provider){

            $providerInstance = new $provider;

            $taskModels = array_merge($taskModels , $providerInstance->getTasks());

        }

        return $taskModels;

    }

    public function saveTasks($taskModels): array
    {
        foreach ($taskModels as $task) {

            Task::firstOrCreate(
                ['name' => $task['name']],
                $task
            );

        }

        return $taskModels;

    }

}
