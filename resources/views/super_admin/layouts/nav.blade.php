<section class="no-print">
    <nav class="navbar navbar-default bg-white m-4">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('superadmin.index') }}"><i class="fa fas fa-user-shield"></i> {{__('superadmin.superadmin')}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'business') class="active" @endif><a href="#">@lang('superadmin.all_business')</a></li>

                 <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'superadmin-subscription') class="active" @endif><a href="#">@lang('superadmin.subscription')</a></li> 

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'packages') class="active" @endif><a href="{{ route('package.index')}} ">@lang('superadmin.subscription_packages')</a></li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'settings') class="active" @endif><a href="#">@lang('superadmin.super_admin_settings')</a></li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'communicator') class="active" @endif><a href="#">@lang('superadmin.communicator')</a></li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'affiliate') class="active" @endif><a href="#">Affiliate</a></li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'notice') class="active" @endif><a href="#">Notice</a></li>

                    <li @if(request()->segment(1) == 'superadmin' && request()->segment(2) == 'superadmin-message') class="active" @endif><a href="#">SMS</a></li> 
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>