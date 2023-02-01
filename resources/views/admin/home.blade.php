@extends('layouts.admin.app')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">

                        <!-- Roles -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="lock" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">الصلاحيات</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\Role::Roles()->count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Roles ends -->
                
                        <!-- Cities -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="flag" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">المحافظات</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\City::count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Cities ends -->

                        <!-- Admins -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">المشرفين</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\User::whereRoleIs(['admin'])->count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Admins ends -->

                        <!-- Clients -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">العملاء</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\User::whereRoleIs(['client'])->count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Clients ends -->
                                               
                        <!-- Captains -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">الكابتن</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\User::whereRoleIs(['captain'])->count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Captains ends -->

                        <!-- Categories -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="list" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">الأقسام</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\Category::count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Categories ends -->

                        <!-- Services -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="crop" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">الخدمات</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\Service::count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Services ends -->

                        <!-- Car Types -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i  class="fas fa-car"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">أنواع السيارات</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\CarType::count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!--  Car Types ends -->

                        <!-- Car Models -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i  class="fas fa-car"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">موديلات السيارات</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\CarModel::count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!--  Car Models ends -->
                                                
                        <!-- Products -->
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="tag" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1 mb-1" style="font-size:18px">المنتجات</h2>
                                    <p class="card-text"><span class="badge badge-pill badge-light-primary mr-1">{{ \App\Models\Product::count() }}</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Products ends -->
                    </div>

                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
@endsection
