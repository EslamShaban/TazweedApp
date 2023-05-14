@extends('layouts.admin.app')

@section('title', __('models.wash_request_details'))

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
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.wash_request_details') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="request-client-captain-details">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="user-card">
                                <h4>{{ __('admin.client_data') }}</h4>
                                <hr>
                                <div class="flex" style="display: flex">
                                    <div class="image" style="margin-left:10px">
                                        <img src="{{ $wash_request->client->image_path }}"  height="50" width="50" >
                                    </div>
                                                                
                                    <div class="user-data">
                                        <p><span style="font-weight:bold"> {{ __('admin.client_name') }} : </span> {{ $wash_request->client->f_name . ' ' . $wash_request->client->l_name}}</p>
                                        <p><span style="font-weight:bold"> {{ __('admin.client_email') }} : </span> {{ $wash_request->client->email }} </p>
                                        <p><span style="font-weight:bold"> {{__('admin.wash_request_count') }} : </span>{{$wash_request->client->client_wash_requests()->count()}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="user-card">
                                <h4>{{ __('admin.captain_data') }}</h4>
                                <hr>
                                <div class="flex" style="display: flex">
                                    <div class="image" style="margin-left:10px">
                                        <img src="{{ $wash_request->captain->image_path }}"  height="50" width="50" >
                                    </div>
                                                                
                                    <div class="user-data">
                                        <p><span style="font-weight:bold"> {{ __('admin.captain_name') }} : </span>{{ $wash_request->captain->f_name . ' ' . $wash_request->captain->l_name}}</p>
                                        <p><span style="font-weight:bold"> {{ __('admin.captain_email') }} : </span>{{ $wash_request->captain->email }}</p>
                                        <p><span style="font-weight:bold"> {{__('admin.wash_request_count') }} : </span>{{$wash_request->captain->captain_wash_requests()->count()}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="request-location request-style">                
                    <div class="col-lg-12 col-12" style="height:100px; padding:0">
                        <div id="map" style="height: 100%;width: 100%;"></div>
                    </div>
                </div>
                                    
                <div class="request-cost request-style">
                    <h4 style="text-align: center">{{ __('admin.service_cost') }}</h4>
                    <div class="price" style="display: flex;justify-content: space-around;">
                        <p>{{ __('admin.service_price') }}</p>
                        <p>{{ \App\Models\Setting::first()->service_price  . ' ' . __('admin.currency')}}</p>
                    </div>
                    <hr>
                    <div class="price" style="display: flex;justify-content: space-around;">
                        <p>{{ __('admin.tax') }}</p>
                        <p>{{ \App\Models\Setting::first()->tax  . ' ' . __('admin.currency')}}</p>
                    </div>
                    <hr>
                    <div class="price" style="display: flex;justify-content: space-around;">
                        <p>{{ __('admin.tip') }}</p>
                        <p>{{ $wash_request->tip  . ' ' . __('admin.currency')}}</p>
                    </div>
                    <hr>
                    <div class="price" style="display: flex;justify-content: space-around;">
                        <p>{{ __('admin.total') }}</p>
                        <p>{{ $wash_request->total_price()  . ' ' . __('admin.currency')}}</p>
                    </div>
                </div>
                <div class="request-images request-style" >
                    <h4 style="text-align: center">{{ __('admin.images') }}</h4>
                    <div class="images" style="display: flex;justify-content: space-around;">
                        <div class="before">
                            <h4 style="text-align: center; margin-bottom:20px"> {{ __('admin.images_before_washing') }} </h4>
                            @foreach ($wash_request->images('before') as $image)
                            	<img class="request-img" src="{{ $image }}" onclick="showPopup(this.src)">
                                <div class="popup" onclick="hidePopup()">
                                    <img id="popupImg">
                                </div>
                            @endforeach
                        </div>
                        <div class="after">
                            <h4 style="text-align: center; margin-bottom:20px"> {{ __('admin.images_after_washing') }} </h4>
                            @foreach ($wash_request->images('after') as $image)
                                <img class="request-img" src="{{ $image }}" onclick="showPopup(this.src)">
                                <div class="popup" onclick="hidePopup()">
                                    <img id="popupImg">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="accordion-with-shadow" style="margin-top:20px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="accordionWrapa10" role="tablist" aria-multiselectable="true">
                                <div class="card collapse-icon">
                                    <div class="card-header">
                                        <h4 class="card-title" style="text-align: center">{{ __('admin.questions') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="collapse-shadow">
                                            @foreach (\App\Models\Question::get() as $index=>$question)
                                                <div class="card">
                                                    <div id="heading{{$index}}" class="card-header" data-toggle="collapse" role="button" data-target="#accordion{{$index}}" aria-expanded="false" aria-controls="accordion{{$index}}">
                                                        <span class="lead collapse-title"> {{$question->question}}</span>
                                                    </div>
                                                    <div id="accordion{{$index}}" role="tabpanel" data-parent="#accordionWrapa10" aria-labelledby="heading11" class="collapse">
                                                        <div class="card-body">
                                                            {{ $wash_request->question_answer($question->id) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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