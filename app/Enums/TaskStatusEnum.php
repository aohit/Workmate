<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case  pending = 'Pending';
    case  inProgress = 'In-Progress';
    case  delayed = 'Delayed';
    case  testing = 'Testing';
    case  completed = 'Completed';
}