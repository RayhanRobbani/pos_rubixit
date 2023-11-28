@extends('layouts.app')
@section('title', __('superadmin.superadmin') . ' | ' . __('superadmin.packages'))

@section('content')
    @include('super_admin.layouts.nav')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('superadmin.packages') <small>@lang('superadmin.update_package')</small></h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Page level currency setting -->
        <input type="hidden" id="p_code" value="{{ $currency->code }}">
        <input type="hidden" id="p_symbol" value="{{ $currency->symbol }}">
        <input type="hidden" id="p_thousand" value="{{ $currency->thousand_separator }}">
        <input type="hidden" id="p_decimal" value="{{ $currency->decimal_separator }}">

		{!! Form::open([
			'url' => route('package.update', [$package->id]),
			'method' => 'PUT',
			'id' => 'update_package_form',
		]) !!}

        <div class="box box-solid">
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('name', __('lang_v1.name') . ':') !!}
                            {!! Form::text('name', $package->name, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    {{-- <div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('description', __('superadmin.description').':') !!}
						{!! Form::text('description', null, ['class' => 'form-control', 'required']); !!}
					</div>
				</div> --}}

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('location_limit', __('superadmin.user_limit') . ':') !!}
                            {!! Form::number('location_limit', $package->location_limit, [
                                'class' => 'form-control',
                                'required',
                                'min' => 0,
                            ]) !!}

                            <span class="help-block">
                                @lang('superadmin.infinite_help')
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('user_limit', __('superadmin.user_limit') . ':') !!}
                            {!! Form::number('user_limit', $package->user_limit, ['class' => 'form-control', 'required', 'min' => 0]) !!}

                            <span class="help-block">
                                @lang('superadmin.infinite_help')
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('product_limit', __('superadmin.product_limit') . ':') !!}
                            {!! Form::number('product_limit', $package->product_limit, ['class' => 'form-control', 'required', 'min' => 0]) !!}

                            <span class="help-block">
                                @lang('superadmin.infinite_help')
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('monthly_fee', __('superadmin.monthly_fee') . ':') !!}
                            @show_tooltip(__('superadmin.tooltip_pkg_price'))

                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3"><b>{{ $currency->code }}
                                        {{ $currency->symbol }}</b></span>
                                {!! Form::text('monthly_fee', $package->monthly_fee, ['class' => 'form-control input_number', 'required']) !!}
                            </div>
                            <span class="help-block">
                                0 = @lang('superadmin.free_package')
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('setup_fee', __('superadmin.setup_fee') . ':') !!}
                            @show_tooltip(__('superadmin.tooltip_setup_fee'))

                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3"><b>{{ $currency->code }}
                                        {{ $currency->symbol }}</b></span>
                                {!! Form::text('setup_fee', $package->setup_fee, ['class' => 'form-control input_number']) !!}
                            </div>
                            <span class="help-block">
                                0 = @lang('superadmin.free_setupfee')
                            </span>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-3">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('is_active', 1, $package->is_active == 1, ['class' => 'input-icheck']) !!}
                                {{ __('superadmin.is_active') }}
                            </label>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right ">@lang('messages.save')</button>
                    </div>
                </div>

            </div>
        </div>

        {!! Form::close() !!}
    </section>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('form#update_package_form').validate();
        });
        $('#enable_custom_link').on('ifChecked', function(event) {
            $("div#custom_link_div").removeClass('hide');
        });
        $('#enable_custom_link').on('ifUnchecked', function(event) {
            $("div#custom_link_div").addClass('hide');
        });
    </script>
@endsection
