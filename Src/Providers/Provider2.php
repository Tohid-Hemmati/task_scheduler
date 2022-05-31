<?php

namespace Src\Providers;

use Illuminate\Support\Facades\Http;
use Src\Models\Task;

class Provider2 implements TaskProviderInterface
{
    //Business Task

    private const BASE_URL = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';

    private function fetchTasks(): object|array
    {
        return Http::get(self::BASE_URL)->json();
    }

    private function parse($tasks)
    {
        $list = [];

        foreach ($tasks as  $task) {

            $firstKey = array_key_first($task);

            $list[] = [
                'name'=> $firstKey,
                'level'=> $task[$firstKey]['level'],
                'duration'=> $task[$firstKey]['estimated_duration']
            ];
        }
        return $list;
    }

    public function getTasks(): array
    {
        return $this->parse($this->fetchTasks());
    }

}
