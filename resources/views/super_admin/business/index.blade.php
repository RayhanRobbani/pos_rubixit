@extends('layouts.app')
@section('title', __('superadmin.superadmin') . ' | Business')

@section('content')
@include('super_admin.layouts.nav')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'superadmin.all_business' )
        <small>@lang( 'superadmin.manage_business' )</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @component('components.filters', ['title' => __('report.filters')])
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('package_id',  __('superadmin.packages') . ':') !!}
                {!! Form::select('package_id', $packages, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('subscription_status',  __('superadmin.subscription_status') . ':') !!}
                {!! Form::select('subscription_status', $subscription_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('is_active',  __('sale.status') . ':') !!}
                {!! Form::select('is_active', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('last_transaction_date',  __('superadmin.last_transaction_date') . ':') !!}
                {!! Form::select('last_transaction_date', $last_transaction_date, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('no_transaction_since',  __('superadmin.no_transaction_since') . ':') !!}
                {!! Form::select('no_transaction_since', $last_transaction_date, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>
    @endcomponent
	<div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">&nbsp;</h3>
        	<div class="box-tools">
                <a href="{{action('App\Http\Controllers\SuperAdmin\BusinessController@create')}}" 
                    class="btn btn-block btn-primary">
                	<i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
            </div>
        </div>

        <div class="box-body">
            @can('superadmin')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="superadmin_business_table">
                        <thead>
                            <tr>
                                <th>
                                    @lang('superadmin.registered_on')
                                </th>
                                <th>Business ID</th>
                                <th>@lang( 'superadmin.business_name' )</th>
                                <th>@lang('business.owner')</th>
                                <th>@lang('business.email')</th>
                                <th>@lang('superadmin.owner_number')</th>
                                <th>@lang( 'superadmin.business_contact_number' )</th>
                                <th>@lang('business.address')</th>
                                <th>@lang( 'sale.status' )</th>
                                <th>@lang( 'superadmin.current_subscription' )</th>
                                <th>@lang('superadmin.last_subscription')</th>
                                <th>@lang( 'business.created_by' )</th>
                                <th>@lang( 'superadmin.setup_fee' )</th>
                                 <th>@lang('superadmin.credentials')</th>
                                <th>@lang( 'superadmin.action' )</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan
        </div>
    </div>

</section>
<!-- /.content -->

@endsection

@section('javascript')

<script type="text/javascript">
    
</script>

@endsection