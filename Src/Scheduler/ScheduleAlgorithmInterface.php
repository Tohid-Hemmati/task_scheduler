<?php

namespace Src\Scheduler;


interface ScheduleAlgorithmInterface {

    public function assign( $task ,  $dev ) : array;

}
