@extends('layouts.app')
@section('title', __('superadmin.superadmin') . ' | ' . __('superadmin.packages'))

@section('content')
    @include('super_admin.layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('superadmin.packages') <small>@lang('superadmin.all_packages')</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- @include('superadmin::layouts.partials.currency') --}}

        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">&nbsp;</h3>
                <div class="box-tools">
                    <a href="{{ route('package.create') }}" class="btn btn-block btn-primary">
                        <i class="fa fa-plus"></i> @lang('messages.add')</a>
                </div>
            </div>

            <div class="box-body">
                @foreach ($packages as $package)
                    <div class="col-md-4">

                        <div class="box box-success hvr-grow-shadow">
                            <div class="box-header with-border text-center">
                                <h2 class="box-title">{{ $package->name }}</h2>

                                <div class="row">

                                    @if ($package->is_active == 1)
                                        <span class="badge bg-green">
                                            @lang('superadmin.active')
                                        </span>
                                    @else
                                        <span class="badge bg-red">
                                            @lang('superadmin.inactive')
                                        </span>
                                    @endif

                                    <a href="{{ route('package.edit', [$package->id]) }}" class="btn btn-box-tool"
                                        title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('package.destroy', [$package->id]) }}"
                                        class="btn btn-box-tool link_confirmation" title="delete"><i
                                            class="fa fa-trash"></i></a>

                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body text-center">

                                @if ($package->location_limit == 0)
                                    @lang('superadmin.unlimited')
                                @else
                                    {{ $package->location_limit }}
                                @endif

                                @lang('superadmin.business_locations')
                                <br />

                                @if ($package->user_limit == 0)
                                    @lang('superadmin.unlimited')
                                @else
                                    {{ $package->user_limit }}
                                @endif

                                @lang('superadmin.users')
                                <br />

                                @if ($package->product_limit == 0)
                                    @lang('superadmin.unlimited')
                                @else
                                    {{ $package->product_limit }}
                                @endif

                                @lang('superadmin.products')
                                <br />
                                <h3 class="text-center">
                                    @if ($package->monthly_fee != 0)
                                        <span class="display_currency" data-currency_symbol="true">
                                            {{ $package->monthly_fee }}
                                        </span>
                                    @endif
                                </h3>

                            </div>
                            <!-- /.box-body -->

                            {{-- <div class="box-footer text-center">
                                {{ $package->description }}
                            </div> --}}
                        </div>
                        <!-- /.box -->
                    </div>
                    @if ($loop->iteration % 3 == 0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach

                <div class="col-md-12">
                    {{ $packages->links() }}
                </div>
            </div>

        </div>

        <div class="modal fade brands_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->

@endsection
