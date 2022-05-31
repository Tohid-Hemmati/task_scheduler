<?php

namespace Src\Providers;

use Illuminate\Support\Facades\Http;
use Src\Models\Task;

class Provider1 implements TaskProviderInterface
{
    //IT Task

    private const BASE_URL = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';

    private function fetchTasks(): object|array
    {
        return Http::get(self::BASE_URL)->object();
    }

    private function parse($tasks): array
    {
        $list = [];

        foreach ($tasks as $task) {
            $list[] =[
                'name'=> $task->id,
                'level'=> $task->zorluk,
                'duration'=> $task->sure
            ];
        }

        return $list;
    }

    public function getTasks(): array
    {

        return  $this->parse($this->fetchTasks());
    }

}
