@extends('layouts.admin.app')

@section('title' , __('admin.add_captain'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.captains.index') }}">{{ __('admin.captains')}}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.add_captain')}}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ __('admin.add_captain')}}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.captains.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">           
                                                <label for="image">{{ __('admin.image')}}</label>
                                                <div class="uploadOuter">
                                                    <span class="dragBox" >
                                                        <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                        <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                    </span>
                                                </div>
                                                <div id="preview"></div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="f_name">{{ __('admin.f_name')}}</label>
                                                <input type="text" id="f_name" class="form-control" name="f_name" value="{{ old('f_name') }}" required/>
                                                @error('f_name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="l_name">{{ __('admin.l_name')}}</label>
                                                <input type="text" id="l_name" class="form-control" name="l_name" value="{{ old('l_name') }}" required/>
                                                @error('l_name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                          
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">{{ __('admin.email')}}</label>
                                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required/>
                                                @error('email')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="phone">{{ __('admin.phone')}}</label>
                                                <input type="text" id="phone" class="form-control" name="phone" value="{{ old('phone') }}" required/>
                                                @error('phone')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="password">{{ __('admin.password')}}</label>
                                                <input type="password" id="password" class="form-control" name="password" value="{{ old('password') }}" required/>
                                                @error('password')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="city_id">{{ __('admin.city')}}</label>
                                                <select name="city_id" class="form-control" required>
                                                    <option value="">{{ __('admin.choose_city')}}</option>
                                                    @foreach (\App\Models\City::all() as $city)
                                                        <option value="{{ $city->id }}" {{ $city->id == old('city_id') ? 'selected' : ''}}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <h2 class="card-title">{{ __('admin.car_data')}}</h2>
                                                <hr>
                                                                                            
                                                <div class="col-md-6 col-12 mb-3 mt-2">
                                                    <label for="plate_number" class="form-label">{{ __('admin.plate_number')}}</label>
                                                    <input type="text" id="plate_number" class="form-control" name="plate_number" value="{{ old('plate_number') }}" required/>
                                                    @error('plate_number')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="phone">{{ __('admin.search')}}</label>
                                                <input type="text" class="form-control" name="icon" id="searchInput" value="{{ old('location') }}"/>
                                            </div>

                                                                                 
                                            <div class="col-12 mb-3" style="height:100vh">
                                                <input type="hidden" name="location" class="form-control" id="location"  value="{{ old('location') }}">
                                                <input type="hidden" name="lat" class="form-control" id="lat"  value="{{ old('lat') }}">
                                                <input type="hidden" name="lng" class="form-control" id="lng"  value="{{ old('lng') }}">
                                                <div id="map" style="height: 100%;width: 100%;">
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mt-1"> {{ __('admin.save')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('js')
    
<script>

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 30.0444196, lng: 31.2357116},
            zoom: 13
        });

        var input = document.getElementById('searchInput');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true,
            icon:"{{ asset('assets/images/icon2.png')}}",
            position: new google.maps.LatLng(30.0444196, 31.2357116),
        });
        // marker.setPosition({lat: 30.0444196, lng: 31.2357116});

        google.maps.event.addListener(map, 'click', function (event) {
            console.log('Lat: ' + event.latLng.lat() + ' Lng:' + event.latLng.lng() + ' from click event');
            marker.setPosition(event.latLng);
        });

                
        marker.addListener('position_changed', printMarkerLocation);

        function printMarkerLocation() {

            document.getElementById('lat').value = marker.position.lat();
            document.getElementById('lng').value = marker.position.lng();

            console.log('Lat: ' + marker.position.lat() + ' Lng:' + marker.position.lng() + ' from marker event' );
        }
        autocomplete.addListener('place_changed', function () {

            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }


            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            Location
            document.getElementById('location').value = place.formatted_address;
        });

    }

</script>

@endsection
