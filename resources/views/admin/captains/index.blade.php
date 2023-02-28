@extends('layouts.admin.app')

@section('title', __('admin.captains'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"> {{__('admin.captains')}}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a Captain">
                                <a href="{{ route('admin.captains.create') }}" class="btn btn-primary">
                                    <span><i class="fa fa-plus"></i></span>
                                    <span> {{ __('admin.add_captain')}} </span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                                
                {{-- <div class="col-lg-12 col-12" style="height:80vh">
                    <div id="map" style="height: 100%;width: 100%;">
                </div> --}}
                <!-- Basic table -->
                <section id="basic-datatable">

                    <!-- Roles Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('admin.image') }}</th>
                                                <th>{{ __('admin.f_name') }}</th>
                                                <th>{{ __('admin.l_name') }}</th>
                                                <th>{{ __('admin.city') }}</th>
                                                <th>{{ __('admin.email') }}</th>
                                                <th>{{ __('admin.created_at')}}</th>
                                                <th>{{ __('admin.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($captains as $index=>$captain )
                                                <tr>                  
                                                    <td>{{$index + 1 }}</td>
                                                    <td>                                        
                                                        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{{ $captain->f_name }}">
                                                            <img src="{{ $captain->image_path }}" alt="Avatar" height="50" width="50" />
                                                        </div>
                                                    </td>
                                                    <td>{{ $captain->f_name }}</td>
                                                    <td>{{ $captain->l_name }}</td>
                                                    <td>{{ $captain->city->name }}</td>
                                                    <td>{{ $captain->email }}</td>
                                                    <td>{{ $captain->created_at->diffForHumans() }}</td>
                                                    <td>  
                                                        @if(auth()->user()->hasPermission('captains-update'))
                                                        <a href="{{route('admin.captains.edit', $captain->id)}}" class="edit-btn"><i class="fa fa-edit fa-sm"></i> </a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('captains-delete'))
                                                            <a href="#" class="delete-btn deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$captain->id}}')"><i class="fa fa-trash fa-sm"></i> </a>
                                                        @endif
                                                        <form action="{{route('admin.captains.destroy', $captain->id)}}" method="POST" id="delete_item_{{$captain->id}}">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete"/>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Roles Table Card -->

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
@endsection


@section('js')
    
    <script>
        var captains = <?php echo $captains; ?>;
        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 30.0444196, lng: 31.2357116},
                zoom: 13
            });

            

            // Create markers.
            for (let i = 0; i < captains.length; i++) {
                var infowindow = new google.maps.InfoWindow();
                const marker = new google.maps.Marker({
                    map: map,
                    draggable: false,
                    icon:"{{ asset('assets/images/icon2.png')}}",
                    position: new google.maps.LatLng(captains[i].lat, captains[i].lng),
                });
                            
                var content = `
                    <div style="display:flex">
                        <div class="img">
                            <img src="`+captains[i].image_path+`" height="50" width="50" style="border-radius:50%">
                        </div>
                        <div class="info">
                            <h2 style="line-height: 50px;margin-right: 5px;">`+captains[i].f_name + ' ' + captains[i].l_name +`</h2>
                        </div>
                        
                    </div>
                `;
                infowindow.setContent(content);
                infowindow.open(map, marker);
            }
        }

    </script>

@endsection
