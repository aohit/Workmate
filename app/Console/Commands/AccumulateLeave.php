<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MyController;
use App\Models\User;

class AccumulateLeave extends Command
{
    protected $signature = 'cron:accumulate-leave';
    protected $description = 'Run the Status cron job';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();
    
        foreach ($users as $user) {
            $leaveEntryExists = \App\Models\AccumulatedLeave::where('employee_id', $user->id)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->exists();
    
            $hours = 1.75*8;
            $minutes = 1.75*480;
            if (!$leaveEntryExists) {
                \App\Models\AccumulatedLeave::create([
                    'employee_id' => $user->id,
                    'accumulated_leave' => 1.75,
                    'accumulate_leave_hours' => $hours,
                    'accumulate_leave_minutes' => $minutes,
                    // 'accumulate_leave_hours' => now()->format('F'),
                    // 'accumulate_leave_minutes' => now()->year,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);        
            }

            $totalAccumulatedLeave = \App\Models\AccumulatedLeave::where('employee_id', $user->id)
            ->sum('accumulated_leave');

        $user->update([
            'total_accumulated_leave' => $totalAccumulatedLeave,
        ]);
        }
    
        info('Leave entries for all users have been added successfully.');
    }
    
}

