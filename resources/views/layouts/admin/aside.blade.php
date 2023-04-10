<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="../../../html/rtl/vertical-menu-template/index.html">
                    <span class="brand-logo text-center">
                        {{-- <svg id="svgexport-6_-_2022-07-22T211411.842" data-name="svgexport-6 - 2022-07-22T211411.842" xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 130.914 131.229">
                            <g id="Group_6192" data-name="Group 6192" transform="translate(0 0)">
                                <g id="Group_6190" data-name="Group 6190" transform="translate(8.446 10.57)">
                                <path id="Path_990" data-name="Path 990" d="M105.353,85.387a18.942,18.942,0,0,1,4.223.488V24.8L56.788,5.006,4,24.8V95.3l52.788,19.8L86.368,104a19,19,0,0,1,18.985-18.613Z" transform="translate(-4 -5.006)" fill="#ffa64d"/>
                                </g>
                                <g id="Group_6191" data-name="Group 6191">
                                <path id="Path_991" data-name="Path 991" d="M52.889,60.474l-2.61-2.612-2.986,2.986,5.836,5.836L67.281,50.172l-3.205-2.749Z" transform="translate(52.567 52.712)"/>
                                <path id="Path_992" data-name="Path 992" d="M122.468,93.1V24.057L61.234,0,0,24.057v83.116l61.234,24.057L91,119.533A21.1,21.1,0,1,0,122.468,93.1ZM61.234,126.691l-57.011-22.4V26.935l57.011-22.4,57.011,22.4V90.614a20.96,20.96,0,0,0-21.06,2.447H93.448c.068-.19.146-.376.2-.574l.912-3.649H97.13a8.455,8.455,0,0,0,8.446-8.446V67.723a8.458,8.458,0,0,0-6.7-8.26l-.04-.186h2.517a4.227,4.227,0,0,0,4.223-4.223V50.831a4.227,4.227,0,0,0-4.223-4.223H96.121L94.647,39.73A12.735,12.735,0,0,0,82.261,29.715H40.208A12.733,12.733,0,0,0,27.821,39.73l-1.474,6.877H21.115a4.227,4.227,0,0,0-4.223,4.223v4.223a4.227,4.227,0,0,0,4.223,4.223h2.517l-.04.186a8.462,8.462,0,0,0-6.7,8.262V80.394a8.455,8.455,0,0,0,8.446,8.446h2.576l.912,3.649c.051.2.129.384.2.574H16.892v4.223H92.949A20.853,20.853,0,0,0,89.474,115.6ZM32.921,91.463l-.655-2.623H43.751L43.1,91.463a2.112,2.112,0,0,1-2.05,1.6H34.971a2.11,2.11,0,0,1-2.05-1.6Zm64.106-40.63h4.327v4.223H97.932Zm-2.508,8.446h-4.1L87.21,43.257A6.349,6.349,0,0,0,81,38.164H41.47a6.347,6.347,0,0,0-6.21,5.093L32.055,59.279h-4.1l4-18.662a8.492,8.492,0,0,1,8.258-6.677H82.261a8.49,8.49,0,0,1,8.258,6.677ZM84.208,71.948h8.7v4.223H79.457ZM73.1,76.171H49.367L35.115,63.5H87.354Zm-30.089,0H29.561V71.948h8.7ZM54.9,55.056V50.833H42.23v4.223h4.223v4.223H36.36L39.4,44.084a2.115,2.115,0,0,1,2.069-1.7H81a2.112,2.112,0,0,1,2.069,1.7l3.038,15.195H50.677V55.056Zm-30.364,0H21.115V50.833h4.327Zm.8,8.446h3.421l4.751,4.223H29.561a4.227,4.227,0,0,0-4.223,4.223v4.223a4.227,4.227,0,0,0,4.223,4.223H92.907a4.227,4.227,0,0,0,4.223-4.223V71.948a4.227,4.227,0,0,0-4.223-4.223H88.958L93.709,63.5H97.13a4.227,4.227,0,0,1,4.223,4.223V80.394a4.227,4.227,0,0,1-4.223,4.223H25.338a4.227,4.227,0,0,1-4.223-4.223V67.725A4.227,4.227,0,0,1,25.338,63.5ZM47.19,92.489,48.1,88.84H74.368l.912,3.649c.051.2.129.384.2.574H46.994c.068-.19.146-.376.2-.574Zm32.184-1.026L78.72,88.84H90.2l-.655,2.623a2.112,2.112,0,0,1-2.05,1.6H81.425a2.11,2.11,0,0,1-2.05-1.6ZM109.8,126.848a16.892,16.892,0,1,1,16.892-16.892A16.912,16.912,0,0,1,109.8,126.848Z" transform="translate(0 0)"/>
                                </g>
                            </g>
                        </svg> --}}
                        <img src="{{ \App\Models\Setting::first()->app_logo }}" alt="{{ \App\Models\Setting::first()->app_name }}" style="max-width:55px">
                    </span>
                    <h2 class="brand-text">{{ \App\Models\Setting::first()->app_name }}
                        <br>
                        <span style="font-size:10px;color:#9da0aa">{{\App\Models\Setting::first()->app_info}}</span>
                    </h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin.index') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">{{ __('admin.dashboard') }}</span></a>
                                
            {{-- roles --}}
            @if(auth()->user()->hasPermission('roles-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.roles.index') }}"><i data-feather="lock"></i><span class="menu-title text-truncate" data-i18n="user">{{ __('admin.roles') }}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{ \App\Models\Role::Roles()->count() }})</span></a></li>
            @endif

            {{-- cities --}}
            @if(auth()->user()->hasPermission('cities-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.cities.index') }}"><i data-feather="flag"></i><span class="menu-title text-truncate" data-i18n="user">{{ __('admin.cities') }}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{ \App\Models\City::count() }})</span></a></li>
            @endif

            {{-- admins --}}
            @if(auth()->user()->hasPermission('admins-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.admins.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="user">{{ __('admin.admins') }}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\User::whereRoleIs(['admin'])->count()}})</span></a></li>
            @endif

            {{-- clients --}}
            @if(auth()->user()->hasPermission('clients-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.clients.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.clients')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\User::whereRoleIs(['client'])->count()}})</span></a></li>
            @endif

            {{-- captains --}}
            @if(auth()->user()->hasPermission('captains-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.captains.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.captains')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\User::whereRoleIs(['captain'])->count()}})</span></a></li>
            @endif

            {{-- categories --}}
            @if(auth()->user()->hasPermission('categories-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.categories.index') }}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.categories')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Category::count()}})</span></a></li>
            @endif

            {{-- services --}}
            @if(auth()->user()->hasPermission('services-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.services.index') }}"><i data-feather="crop"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.services')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Service::count()}})</span></a></li>
            @endif

            {{-- car types --}}
            @if(auth()->user()->hasPermission('car_types-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.car_types.index') }}"><i class="fas fa-car"></i><span class="menu-title text-truncate" data-i18n="cars">{{ __('admin.car_types') }}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\CarType::count()}})</span></a></li>
            @endif
            
            {{-- car models --}}
            @if(auth()->user()->hasPermission('car_models-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.car_models.index') }}"><i class="fas fa-car"></i><span class="menu-title text-truncate" data-i18n="user">{{ __('admin.car_models')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\CarModel::count()}})</span></a></li>
            @endif

            {{-- products --}}
            @if(auth()->user()->hasPermission('products-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.products.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.products')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Product::count()}})</span></a></li>
            @endif
     
            {{-- address types --}}
            @if(auth()->user()->hasPermission('address_types-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.address_types.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.address_types')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\AddressType::count()}})</span></a></li>
            @endif

            {{-- coupons --}}
            @if(auth()->user()->hasPermission('coupons-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.coupons.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.coupons')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Coupon::count()}})</span></a></li>
            @endif

            {{-- orders --}}
            @if(auth()->user()->hasPermission('orders-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.orders.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.orders')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Order::count()}})</span></a></li>
            @endif

            {{-- questions --}}
            @if(auth()->user()->hasPermission('questions-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.questions.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.questions')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Question::count()}})</span></a></li>
            @endif

            {{-- wash requests --}}
            @if(auth()->user()->hasPermission('wash_requests-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.wash_requests.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.wash_requests')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\WashRequest::count()}})</span></a></li>
            @endif

            {{-- settings --}}
            @if(auth()->user()->hasPermission('settings-read'))
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('admin.settings.index') }}"><i data-feather="tag"></i><span class="menu-title text-truncate" data-i18n="user">{{__('admin.settings')}}</span><span class="badge badge-light-primary badge-pill ml-auto mr-1">({{\App\Models\Setting::count()}})</span></a></li>
            @endif

            {{--  reports  --}}            
            @if(auth()->user()->hasPermission('reports-read'))

                <li class=" nav-item ">
                    <a class="d-flex align-items-center" href="#"><i data-feather="file"></i><span class="menu-title text-truncate" data-i18n="user">{{ __('admin.reports') }}</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('admin.reports.index') }}"><i data-feather="file"></i><span class="menu-item text-truncate" data-i18n="List">{{ __('admin.bw_dates_reports') }}</span></a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('admin.reports.captain_reports') }}"><i data-feather="file"></i><span class="menu-item text-truncate" data-i18n="List">{{ __('admin.captain_reports') }}</span></a>
                        </li>                 
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('admin.reports.captain_requests_statistics') }}"><i data-feather="file"></i><span class="menu-item text-truncate" data-i18n="List">{{ __('admin.captain_requests_statistics') }}</span></a>
                        </li>
                        <li>
                            <a class="d-flex align-items-center" href="{{ route('admin.reports.bw_dates_orders_report') }}"><i data-feather="file"></i><span class="menu-item text-truncate" data-i18n="List">{{ __('admin.bw_dates_orders_report') }}</span></a>
                        </li>
                    </ul>
                </li>

            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->