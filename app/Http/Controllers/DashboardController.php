<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //index
    public function index() {
        $total_sales = Order::sum('total_price');
        $total_count = Order::count();

        $sales_today = Order::whereDate('transaction_time',date('Y-m-d'))->sum('total_price');
        $count_today = Order::whereDate('transaction_time',date('Y-m-d'))->count();

        $sales_before = Order::whereDate('transaction_time',date('Y-m-d',strtotime("yesterday")))->sum('total_price');
        $count_before = Order::whereDate('transaction_time',date('Y-m-d',strtotime("yesterday")))->count();

        $total_price = DB::table('order_items')
        ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
        ->sum(DB::raw('order_items.quantity * products.price'));

        $total_cost = DB::table('order_items')
        ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
        ->sum(DB::raw('order_items.quantity * products.cost_price'));

        $total_profit = $total_price - $total_cost;

        $bulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $sales_monthly = [];

        foreach ($bulan as $b) {
            $sales_monthly[] = Order::whereDate('transaction_time','like','%'.date('Y').'-'.$b.'%')->sum('total_price');
        }

        return view('pages.dashboard', [
            'total_sales'     => $total_sales,
            'total_count'     => $total_count,
            'sales_today'     => $sales_today,
            'count_today'     => $count_today,
            'sales_before'    => $sales_before,
            'count_before'    => $count_before,
            'total_cost'      => $total_cost,
            'total_profit'    => $total_profit,
            'sales_monthly'   => $sales_monthly
        ]);
    }
}
