<?php

namespace Task\Cli;

use Task\Project;

class ProjectFinder
{
    public function find($taskfile = './Taskfile')
    {
        if (!file_exists($taskfile)) {
            throw new \InvalidArgumentException("$taskfile not found");
        }

        if (filesize($taskfile) === 0) {
            throw new \LogicException("Taskfile is empty");
        }

        $project = require $taskfile;

        $cls = 'Task\Project';
        if (!($project instanceof $cls)) {
            throw new \LogicException("Taskfile must return a Project");
        }

        return $project;
    }
}
