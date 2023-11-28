<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Package;
use App\System;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $businessUtil;
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

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
        $packages = Package::paginate(20);

        //Get all module permissions and convert them into name => label
        $permissions = $this->moduleUtil->getModuleData('superadmin_package');
        $permission_formatted = [];
        foreach ($permissions as $permission) {
            foreach ($permission as $details) {
                $permission_formatted[$details['name']] = $details['label'];
            }
        }

        return view('super_admin.packages.index')
            ->with(compact('packages', 'permission_formatted'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        //
        $intervals = ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')];
        $currency = System::getCurrency();
        $permissions = $this->moduleUtil->getModuleData('superadmin_package');
        return view('super_admin.packages.create')
            ->with(compact('intervals', 'currency', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        //
        try {
            $input = $request->only(['name', 'location_limit', 'user_limit', 'product_limit', 'monthly_fee', 'setup_fee']);
            $currency = System::getCurrency();
            $input['setup_fee'] = $this->businessUtil->num_uf($input['setup_fee'], $currency);
            $input['name'] = $request->name;
            $input['location_limit'] = $request->location_limit;
            $input['user_limit'] = $request->user_limit;
            $input['product_limit'] = $request->product_limit;
            $input['monthly_fee'] = $request->monthly_fee;
            $input['setup_fee'] = $request->setup_fee;
            $input['is_active'] = $request->is_active;
            $package = new Package;
            $package->fill($input);
            $package->save();

            $output = ['success' => 1, 'msg' => __('lang_v1.success')];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect()
            ->route('package.index')
            ->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

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
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        //package
        $package = Package::findOrFail($id);
        $currency = System::getCurrency();
        $permissions = $this->moduleUtil->getModuleData('superadmin_package');
        return view('super_admin.packages.edit', compact('package', 'permissions', 'currency'));

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
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $package = Package::findOrFail($id);
            $package->update($request->all());

            $output = ['success' => 1, 'msg' => __('superadmin.update_success')];
            return redirect()->route('package.index')->with('status', $output);
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            // Handle any exceptions that occur during the update
            $output = ['success' => 0, 'msg' => __('superadmin.update_failed')];
            return redirect()->back()->withInput()->withErrors($output); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $package = Package::find($id);
        $package->delete();
        $output = ['success' => 1, 'msg' => __('superadmin.delete_success')];
        // Redirect to the package index with the success message
        return redirect()->route('package.index')->with('status', $output);
        //
    }
}
