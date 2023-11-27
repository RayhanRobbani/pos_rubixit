<?php

namespace App\Http\Controllers\SuperAdmin;

use App\System;
use App\Business;
use Carbon\Carbon;
use App\Charts\CommonChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $date_filters['this_yr'] = ['start' => Carbon::today()->startOfYear()->toDateString(),
                'end' => Carbon::today()->endOfYear()->toDateString()
            ];
        $date_filters['this_month']['start'] = date('Y-m-01');
        $date_filters['this_month']['end'] = date('Y-m-t');
        $date_filters['this_week']['start'] = date('Y-m-d', strtotime('monday this week'));
        $date_filters['this_week']['end'] = date('Y-m-d', strtotime('sunday this week'));

        // $currency = System::getCurrency();

        //Count all busineses not subscribed.
        $not_subscribed = Business::leftjoin('subscriptions AS s', 'business.id', '=', 's.business_id')
            ->whereNull('s.id')
            ->count();

        // $subscriptions = $this->_monthly_sell_data();

        $monthly_sells_chart = new CommonChart;
        // $monthly_sells_chart->labels(array_keys($subscriptions))
        //     ->dataset(__('superadmin::lang.total_subscriptions', ['currency' => $currency->currency]), 'column', array_values($subscriptions));

        return view('super_admin.superadmin.index')
            ->with(compact(
                'date_filters',
                'not_subscribed',
                // 'monthly_sells_chart'
            ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
