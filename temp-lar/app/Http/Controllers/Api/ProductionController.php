<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductionResult;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductionController extends Controller
{
    //

    public function orders(Request $request)
    {
        //

        $query = WorkOrder::query()
            ->with(['product', 'machine', 'employee']);


        // search prod & wo_number
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($query) use ($search) {
                $query->where('wo_number', 'like', "%$search%")
                    ->orWhereHas('product', function ($prod) use ($search) {
                        $prod->where('product_name', 'like', "%$search%");
                    });
            });
        }

        // prod filter

        if ($request->filled('product')) {
            $product = $request->product;

            $query->where(function ($query) use ($product) {
                $query->where('product_code', $product)
                    ->orWhereHas('product', function ($prod) use ($product) {
                        $prod->where('product_name', 'like', "%$product%");
                    });
            });
        }

        // machine filter
        if ($request->filled('machine')) {
            $query->where('machine_code', $request->machine);
        }

        // status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        //date filter

        if ($request->filled('date')) {
            $query->whereDate('plan_start', $request->date);
        }


        // employee filter
        if ($request->filled('employee')) {
            $query->where('employee_no', $request->employee);
        }

        //sort

        $allowSort = [
            'wo_number',
            'target_qty',
            'plan_start',
            'plan_finish',
            'status',
        ];

        $sort = $request->input('sort', 'plan_start');

        if (!in_array($sort, $allowSort)) {
            $sort = 'plan_start';
        }

        $dir = $request->input('dir', 'desc');

        if (!in_array($dir, ['asc', 'desc'])) {
            $dir = 'desc';
        }

        $query->orderBy($sort, $dir);

        $perPage = min(max((int) $request->input('per_page', 20), 1), 100);

        $orders = $query->paginate($perPage);

        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function store(Request $request)
    {
        //

        $today = Carbon::now('Asia/Jakarta')->startOfDay();

        $validate = Validator::make(
            $request->all(),
            [
                'wo_number' => ['required', 'string', 'exists:work_order,wo_number'],
                'qty_good' => ['required', 'integer', 'min:0'],
                'qty_reject' => ['required', 'integer', 'min:0'],
                'production_date' => [
                    'required',
                    'date',
                    'before_or_equal:' . $today->toDateString()
                ],
                'actual_finish' => [
                    'required',
                    'date',
                    'after_or_equal:production_date'
                ],
                'runtime_minutes' => ['required', 'integer', 'min:0'],

            ]
        );

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validate->errors()
            ], 422);
        }

        $workOrder = WorkOrder::findOrFail($request->wo_number);

        if ($workOrder->status != 'RUNNING') {
            return response()->json([
                'message' => 'Work Order tidak sedang berjalan (RUNNING)',
            ], 422);
        }

        $achievement = $workOrder->target_qty > 0
            ? round(($request->qty_good / $workOrder->target_qty) * 100, 2)
            : 0;

        $prodRes = ProductionResult::create([
            'wo_number' => $request->wo_number,
            'actual_start' => $request->production_date,
            'actual_finish' => $request->actual_finish,
            'runtime_minutes' => $request->runtime_minutes,
            'good_qty' => $request->qty_good,
            'reject_qty' => $request->qty_reject,
            'achievement' => $achievement,
        ]);

        return response()->json([
            'message' => 'Production Result berhasil ditambahkan',
            'data' => $prodRes,


        ], 201);
    }
}
