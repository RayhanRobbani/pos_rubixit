@extends('layouts.app')
@section('title', __('superadmin.superadmin') . ' | Business')

@section('content')
    @include('super_admin.layouts.nav')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('superadmin.all_business')
            <small>@lang('superadmin.manage_business')</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- @component('components.filters', ['title' => __('report.filters')])
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('package_id', __('superadmin.packages') . ':') !!}
                    {!! Form::select('package_id', $packages, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('subscription_status', __('superadmin.subscription_status') . ':') !!}
                    {!! Form::select('subscription_status', $subscription_statuses, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('lang_v1.all'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('is_active', __('sale.status') . ':') !!}
                    {!! Form::select(
                        'is_active',
                        ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')],
                        null,
                        ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')],
                    ) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('last_transaction_date', __('superadmin.last_transaction_date') . ':') !!}
                    {!! Form::select('last_transaction_date', $last_transaction_date, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('messages.please_select'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Form::label('no_transaction_since', __('superadmin.no_transaction_since') . ':') !!}
                    {!! Form::select('no_transaction_since', $last_transaction_date, null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'placeholder' => __('messages.please_select'),
                    ]) !!}
                </div>
            </div>
        @endcomponent --}}
        <div class="box box-solid">

            <div class="box-body">
                @can('superadmin')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="superadmin_business_table">
                            <thead>
                                <tr>
                                    <th>Registered On</th>
                                    <th>Business ID</th>
                                    <th>Business Name</th>
                                    <th>Owner</th>
                                    <th>Contact No.</th>
                                    <th>Login Credentials</th>
                                    <th>Login Allowed?</th>
                                    <th>Active Subscription</th>
                                    <th>Last Subscription</th>
                                    <th>Actions</th>
                                    {{-- <th>@lang('superadmin.action')</th> --}}
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
        $(document).ready(function() {
            //Date range as a button
            // $('#sell_list_filter_date_range').daterangepicker(
            //     dateRangeSettings,
            //     function(start, end) {
            //         $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(
            //             moment_date_format));
            //         sell_table.ajax.reload();
            //     }
            // );

            // $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            //     $('#sell_list_filter_date_range').val('');
            //     sell_table.ajax.reload();
            // });

            sell_table = $('#superadmin_business_table').DataTable({
                processing: true,
                serverSide: true,
                // aaSorting: [
                //     [1, 'desc']
                // ],
                "ajax": {
                    "url": "/superadmin/superadmin/business",
                    "data": function(d) {
                        // if ($('#sell_list_filter_date_range').val()) {
                        //     var start = $('#sell_list_filter_date_range').data('daterangepicker')
                        //         .startDate.format('YYYY-MM-DD');
                        //     var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate
                        //         .format('YYYY-MM-DD');
                        //     d.start_date = start;
                        //     d.end_date = end;
                        // }
                        // d.is_direct_sale = 1;

                        // d.location_id = $('#sell_list_filter_location_id').val();
                        // d.customer_id = $('#sell_list_filter_customer_id').val();
                        // d.payment_status = $('#sell_list_filter_payment_status').val();
                        // d.created_by = $('#created_by').val();
                        // d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                        // d.service_staffs = $('#service_staffs').val();

                        // if ($('#shipping_status').length) {
                        //     d.shipping_status = $('#shipping_status').val();
                        // }

                        // if ($('#sell_list_filter_source').length) {
                        //     d.source = $('#sell_list_filter_source').val();
                        // }

                        // if ($('#only_subscriptions').is(':checked')) {
                        //     d.only_subscriptions = 1;
                        // }

                        d = __datatable_ajax_callback(d);
                    }
                },
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                columns: [{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'business_id',
                        name: 'business_id'
                    },
                    {
                        data: 'business_name',
                        name: 'business_name'
                    },
                    {
                        data: 'owner',
                        name: 'owner'
                    },
                    {
                        data: 'contact_no',
                        name: 'contact_no'
                    },
                    {
                        data: 'login_credentials',
                        name: 'login_credentials'
                    },
                    {
                        data: 'allow_login',
                        name: 'allow_login'
                    },
                    {
                        data: 'active_subscription',
                        name: 'active_subscription'
                    },
                    {
                        data: 'last_subscription',
                        name: 'last_subscription'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        "searchable": false
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     "searchable": false
                    // },
                    // {
                    //     data: 'transaction_date',
                    //     name: 'transaction_date'
                    // },
                    // {
                    //     data: 'invoice_no',
                    //     name: 'invoice_no'
                    // },
                    // {
                    //     data: 'conatct_name',
                    //     name: 'conatct_name'
                    // },
                    // {
                    //     data: 'mobile',
                    //     name: 'contacts.mobile'
                    // },
                    // {
                    //     data: 'business_location',
                    //     name: 'bl.name'
                    // },
                    // {
                    //     data: 'payment_status',
                    //     name: 'payment_status'
                    // },
                    // {
                    //     data: 'payment_methods',
                    //     orderable: false,
                    //     "searchable": false
                    // },
                    // {
                    //     data: 'final_total',
                    //     name: 'final_total'
                    // },
                    // {
                    //     data: 'total_paid',
                    //     name: 'total_paid',
                    //     "searchable": false
                    // },
                    // {
                    //     data: 'total_remaining',
                    //     name: 'total_remaining'
                    // },
                    // {
                    //     data: 'return_due',
                    //     orderable: false,
                    //     "searchable": false
                    // },
                    // {
                    //     data: 'shipping_status',
                    //     name: 'shipping_status'
                    // },
                    // {
                    //     data: 'total_items',
                    //     name: 'total_items',
                    //     "searchable": false
                    // },
                    // {
                    //     data: 'types_of_service_name',
                    //     name: 'tos.name',
                    //     @if (empty($is_types_service_enabled))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'service_custom_field_1',
                    //     name: 'service_custom_field_1',
                    //     @if (empty($is_types_service_enabled))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'custom_field_1',
                    //     name: 'transactions.custom_field_1',
                    //     @if (empty($custom_labels['sell']['custom_field_1']))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'custom_field_2',
                    //     name: 'transactions.custom_field_2',
                    //     @if (empty($custom_labels['sell']['custom_field_2']))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'custom_field_3',
                    //     name: 'transactions.custom_field_3',
                    //     @if (empty($custom_labels['sell']['custom_field_3']))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'custom_field_4',
                    //     name: 'transactions.custom_field_4',
                    //     @if (empty($custom_labels['sell']['custom_field_4']))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'added_by',
                    //     name: 'u.first_name'
                    // },
                    // {
                    //     data: 'additional_notes',
                    //     name: 'additional_notes'
                    // },
                    // {
                    //     data: 'staff_note',
                    //     name: 'staff_note'
                    // },
                    // {
                    //     data: 'shipping_details',
                    //     name: 'shipping_details'
                    // },
                    // {
                    //     data: 'table_name',
                    //     name: 'tables.name',
                    //     @if (empty($is_tables_enabled))
                    //         visible: false
                    //     @endif
                    // },
                    // {
                    //     data: 'waiter',
                    //     name: 'ss.first_name',
                    //     @if (empty($is_service_staff_enabled))
                    //         visible: false
                    //     @endif
                    // },
                ],
                // "fnDrawCallback": function(oSettings) {
                //     __currency_convert_recursively($('#superadmin_business_table'));
                // },
                // "footerCallback": function(row, data, start, end, display) {
                //     var footer_sale_total = 0;
                //     var footer_total_paid = 0;
                //     var footer_total_remaining = 0;
                //     var footer_total_sell_return_due = 0;
                //     for (var r in data) {
                //         footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(
                //             data[r].final_total).data('orig-value')) : 0;
                //         footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(
                //             data[r].total_paid).data('orig-value')) : 0;
                //         footer_total_remaining += $(data[r].total_remaining).data('orig-value') ?
                //             parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                //         footer_total_sell_return_due += $(data[r].return_due).find('.sell_return_due')
                //             .data('orig-value') ? parseFloat($(data[r].return_due).find(
                //                 '.sell_return_due').data('orig-value')) : 0;
                //     }

                //     $('.footer_total_sell_return_due').html(__currency_trans_from_en(
                //         footer_total_sell_return_due));
                //     $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
                //     $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
                //     $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total));

                //     $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
                //     $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
                //     $('.payment_method_count').html(__count_status(data, 'payment_methods'));
                // },
                // createdRow: function(row, data, dataIndex) {
                //     $(row).find('td:eq(6)').attr('class', 'clickable_td');
                // }
            });

            // $(document).on('change',
            //     '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status, #sell_list_filter_source',
            //     function() {
            //         sell_table.ajax.reload();
            //     });

            // $('#only_subscriptions').on('ifChanged', function(event) {
            //     sell_table.ajax.reload();
            // });
        });
    </script>
@endsection
