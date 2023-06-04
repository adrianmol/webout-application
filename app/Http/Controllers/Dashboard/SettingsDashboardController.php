<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsDashboardController extends Controller
{
    public function index()
    {

        $general = Setting::where('code', 'general')->get()->mapWithKeys(function ($data) {

            return [$data->getAttribute('key') => $data->getAttribute('value')];
        })->toArray();

        return view('pages.settings.index', [
            'general' => $general,
        ]);
    }

    public function storeGeneralSettings(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'general' => [
                'store.url' => 'required',
                'store.api_key' => 'required',
                'erp.url' => 'required',
                'erp.erp_key' => 'required',
            ],
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated);
        }

        $generalSettings = $request->all();

        foreach ($generalSettings['general'] as $key => $value) {

            $fields = [
                'code' => 'general',
                'key' => $key,
                'value' => $value,
            ];

            $keyUpOrIns = [
                'key' => $key,
            ];

            Setting::updateOrInsert($keyUpOrIns, $fields);

        }

        return redirect()->back();
    }
}
