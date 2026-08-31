<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\ProductionResult;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $latestProdDate = ProductionResult::max('actual_start');


        if (!$latestProdDate) {
            return response()->json([
                'summary' => [
                    'total_machine' => Machine::count(),
                    'running_order' => WorkOrder::where('status', 'RUNNING')->count(),
                    'finished_order' => WorkOrder::where('status', 'FINISHED')->count(),
                    'today_target' => 0,
                    'today_good' => 0,
                    'today_reject' => 0,
                    'achievement' => 0,
                ],
                'trend_7_days' => [],
                'status_breakdown' => [],
                'top_machines' => [],
            ]);
        }

        $latestDate = Carbon::parse($latestProdDate)->toDateString();


        $totalMachine = Machine::count();

        $runningOrder = WorkOrder::where('status', 'RUNNING')->count();

        $finishedOrder = WorkOrder::where('status', 'FINISHED')->count();

        // $latestProdDate = ProductionResult::max('actual_start');

        $todayTarget = WorkOrder::whereDate('plan_start', $latestDate)->sum('target_qty');

        $todayGood = ProductionResult::whereDate('actual_start', $latestDate)->sum('good_qty');

        $todayReject = ProductionResult::whereDate('actual_start', $latestDate)->sum('reject_qty');

        $achievement = $todayTarget > 0 ? round(($todayGood / $todayTarget), 1) * 100 : 0;


        //7 days trend

        $startDate = Carbon::parse($latestProdDate)->subDays(6);

        $trend7Days = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);

            $target = WorkOrder::whereDate('plan_start', $date->toDateString())->sum('target_qty');

            $good = ProductionResult::whereDate('actual_start', $date->toDateString())->sum('good_qty');

            $reject = ProductionResult::whereDate('actual_start', $date->toDateString())->sum('reject_qty');

            $dailyAchievement = $target > 0 ? round(($good / $target) * 100, 1) : 0;

            $trend7Days[] = [
                'date' => $date->toDateString(),
                'good_qty' => (int) $good,
                'reject_qty' => (int) $reject,
                'achievement' => $dailyAchievement,
            ];
        }

        //status breakdown

        $statusBreakdown = WorkOrder::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->orderBy('status')
            ->get()
            ->map(function ($item) {
                return [
                    'status' => $item->status,
                    'total' => (int)$item->total,
                ];
            });


        //top machines

        $topMachines = Machine::query()
            ->with('workOrders.productionResults')
            ->get()
            ->map(function ($machine) {
                $goodQty = $machine->workOrders->flatMap(function ($workOrder) {
                    return $workOrder->productionResults;
                })->sum('good_qty');

                $targetQty = $machine->workOrders->sum('target_qty');
                $achievement = $targetQty > 0 ? round(($goodQty / $targetQty) * 100, 1) : 0;

                return [
                    'machine_code' => $machine->machine_code,
                    'machine_name' => $machine->machine_name,
                    'good_qty' => (int) $goodQty,
                    'achievement' => $achievement,
                ];
            })
            ->sortByDesc('good_qty')
            ->take(10)
            ->values();


        return response()->json([
            'summary' => [
                'total_machine' => $totalMachine,
                'running_order' => $runningOrder,
                'finished_order' => $finishedOrder,
                'today_target' => $todayTarget,
                'today_good' => (int) $todayGood,
                'today_reject' => (int) $todayReject,
                'achievement' => $achievement,
            ],
            'trend_7_days' => $trend7Days,
            'status_breakdown' => $statusBreakdown,
            'top_machines' => $topMachines,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function machine(string $id)
    {
        $machine = Machine::findOrFail($id);

        $workOrders = $machine->workOrders()
            ->with([
                'productionResults',
                'downtimes',
            ])
            ->get();

        $totalOrder = $workOrders->count();

        $goodQty = $workOrders->sum(function ($workOrder) {
            return $workOrder->productionResults->sum('good_qty');
        });

        $rejectQty = $workOrders->sum(function ($workOrder) {
            return $workOrder->productionResults->sum('reject_qty');
        });

        $downtimeMinutes = $workOrders->sum(function ($workOrder) {
            return $workOrder->downtimes->sum('duration_minutes');
        });

        $targetQty = $workOrders->sum('target_qty');

        $achievement = $targetQty > 0
            ? round(($goodQty / $targetQty) * 100, 1)
            : 0;

        return response()->json([
            'machine_name' => $machine->machine_name,
            'total_order' => $totalOrder,
            'good_qty' => (int) $goodQty,
            'reject_qty' => (int) $rejectQty,
            'downtime_minutes' => (int) $downtimeMinutes,
            'achievement' => $achievement,
        ]);
    }
}
