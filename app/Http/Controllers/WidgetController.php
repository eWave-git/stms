<?php

namespace App\Http\Controllers;

use App\Models\RawData;
use App\Models\Widget;
use Illuminate\Http\Request;
use Config;
use Carbon\Carbon;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_datas = Config::get('ewave.datas');

        $widgets = Widget::with('device','widgetboardtype','widgetconnectiontime')
            ->get()
            ->map(function($widget) use ($_datas) {
                $widget_name = $widget->widget_name;

                $widgetboardtype = $widget->widgetboardtype->toArray();
                $widgetconnectiontime  = $widget->widgetconnectiontime->toArray();

                $list_raw = RawData::where('address',$widget->address)
                    ->where('board_type', $widget->board_type)
                    ->where('board_number', $widget->board_number)
                    ->orderby('created_at', "desc")
                    ->first(['data1','data2','data3','data4','created_at']);

                $warning = "N";

                if (!empty($widgetconnectiontime)
                    && !empty($list_raw)
                    && $widgetconnectiontime[0]['check_yn'] == 'Y') {
                    $currentDateTime = Carbon::now();

                    $diff = $currentDateTime->diffInMinutes($list_raw->created_at);
                    if ($widgetconnectiontime[0]['check_time'] <= $diff) {
                        $warning = "Y";
                    }

                }

                $datas = array();
                foreach ($_datas as $k => $v) {
                    $datas[$k]['name'] = !empty($widgetboardtype) ? $widgetboardtype[0][$v."_name"] : '';
                    $datas[$k]['symbol'] = !empty($widgetboardtype) ? $widgetboardtype[0][$v."_symbol"] : '';
                    $datas[$k]['display'] = !empty($widgetboardtype) ? $widgetboardtype[0][$v."_display"] : 'N';
                    $datas[$k]['data'] = !empty($list_raw) ? $list_raw->$v : 0;

                    if ($datas[$k]['display'] == 'Y' && $datas[$k]['data'] == 0) {
                        $warning = "Y";
                    }
                }

                return [
                    'widget_name' => $widget_name,
                    'datas' => $datas,
                    'warning' => $warning,
                    'last_created' =>  $list_raw->created_at ?? '',
                ];
            });

        return view('widgets', ['widgets' => $widgets]);
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
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show(Widget $widget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widget $widget)
    {
        //
    }
}
