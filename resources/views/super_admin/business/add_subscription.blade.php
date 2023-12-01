@extends('layouts.app')
@section('title', __('superadmin.superadmin') . ' | Business')

@section('content')
    @include('super_admin.layouts.nav')
    <!-- Main content -->
    <section class="content">

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">@lang('superadmin.add_new_business') <small>(@lang('superadmin.add_business_help'))</small></h3>
            </div>

            <div class="box-body">
                {!! Form::open([
                    'url' => action('App\Http\Controllers\SuperAdmin\BusinessController@store_subscription', [$id]),
                    'method' => 'post',
                ]) !!}

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('package', __('superadmin.package') . ':') !!}
                        {!! Form::select('package', $packages, null, [
                            'class' => 'form-control',
                            'placeholder' => __('messages.please_select'),
                            'required'
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::hidden('user_id', null) !!}
                    </div>
                </div>

                {!! Form::submit(__('messages.submit'), ['class' => 'btn btn-success pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>

        <div class="modal fade brands_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
@endsection
