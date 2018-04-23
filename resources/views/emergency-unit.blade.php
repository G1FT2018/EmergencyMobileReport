@extends('partials.app')
@section('content')
    <div class="container  pad-5">
        <div class="row">
            <div class="col-sm-12">
                <h3>
                    <i class="fa fa-bell" aria-hidden="true"></i>&nbsp; Emergency Alerts
                </h3>
                <hr>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-4">
                <div class="list-group rad-0" id="alerts">
                    @foreach($alerts as $alert)
                    <a href="#" data-toggle="alert-view" data-alertData="{{json_encode($alert)}}" data-station="{{json_encode($alert->station)}}" data-sender="{{$alert->user->username}}"
                    class="list-group-item">
                        <i class="fa fa-bell" aria-hidden="true"></i>&nbsp;
                        <strong>{{$alert->emergency}}</strong>&nbsp; - alert #&nbsp;{{$alert->id}}
                    </a>
                    @endforeach
                </div>
                <!-- /alerts list-->
            </div>
            <!-- ./col -1 -->
            <div class="col-sm-8 ">
                <div class="row std-side-widget" id="no-alert-panel">
                    <div class="col-sm-12 text-center" style="margin-top:100px;">
                        <h4>
                            <i class="fa fa-bell" style="font-size:350%" aria-hidden="true"></i>
                        </h4>
                        <p>Chose an alert to respond to</p>

                    </div>
                </div>
                <!-- ./no user panel -->

                <div class="row std-side-widget active hidden" id="alert-panel" style="padding:5px;">
                    <div class="col-sm-4 ">
                        <div class="text-center">
                            <i style="font-size:1000%" class="fa fa-bell" aria-hidden="true"></i>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <div class="field">
                                <div class="field-label">
                                    <i class="fa fa-tags"></i>&nbsp;
                                    <b>Sent By</b>
                                </div>
                                <div class="field-value" id="v-sender-name">N/A</div>
                            </div>
                            <div class="field">
                                <div class="field-label">
                                    <i class="fa fa-tags"></i>&nbsp;
                                    <b>Time</b>
                                </div>
                                <div class="field-value" id="v-alert-time">N/A</div>
                            </div>
                            <div class="field">
                                <div class="field-label">
                                    <i class="fa fa-tags"></i>&nbsp;
                                    <b>Emergency</b>
                                </div>
                                <div class="field-value" id="v-alert-type">user.pap</div>
                            </div>
                            <div class="field">
                                    <div class="field-label">
                                        <i class="fa fa-tags"></i>&nbsp;
                                        <b>Closest Station</b>
                                    </div>
                                    <div class="field-value" id="v-alert-station">user.pap</div>
                            </div>
                            <div class="field">
                                    <div class="field-label">
                                        <i class="fa fa-tags"></i>&nbsp;
                                        <b>Station Contact #</b>
                                    </div>
                                    <div class="field-value" id="v-alert-phone">user.pap</div>
                            </div>
                         

                        </div>

                    </div>
                    <div class="col-sm-8 p-5" >
                          <div id="map-view">

                          </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- ./row -->

    </div>
    <!-- ./container -->
@stop
@section('scripts')
    <script>
        //generate listen URL with upper bound URL
        var upperBound="{{(count($alerts)!=0) ? $alerts[0]->id : 0}}"; //get the first alert as the upper bound as this is the last one that was received
        var rawURL="{{URL('emergency-listen')}}";
        var getURL=rawURL+'/'+upperBound;
        var mapURL="{{URL('map-view')}}";
    </script>
    <script>
            
            $(document).ready(function () {
                //set current username in navbar
                var currentAlert;
                function initAlerts(){
                    $('[data-toggle="alert-view"]').on('click', function () {
                        alert=JSON.parse($(this).attr('data-alertData'));
                        station=JSON.parse($(this).attr('data-station'));
                        currentAlert=alert;
                        //set map view url to include coordinates for this user
                        var mapViewURL=mapURL+'/'+alert.coordinates.latitude+'/'+alert.coordinates.longitude;
                        var mapView='<iframe style="width:100%;height:500px;"  src="'+mapViewURL+'"></iframe>';
                        console.log(mapViewURL);
                        $('#v-sender-name').text($(this).attr('data-sender'));
                        $('#v-alert-type').text(alert.emergency);
                        $('#v-alert-time').text(alert.created_at);
                        $('#v-alert-station').text(station.name);
                        $('#v-alert-phone').text(station.phone);

                        $('#map-view').html(mapView);

                        //set alert attr
                        $('#no-alert-panel').addClass('hidden');
                        $('#alert-panel').removeClass('hidden');
                    });
                }
                initAlerts();

                //@brief handles the popups
                function alertUser(message){
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                    toastr.success(message);
                }
                /**
                * @brief checks for a new alert every 10 seconds 
                */
                var timer=setInterval(function(){
                    $.get(getURL,function(data,status){
                        if(status){
                            alerts=JSON.parse(data);
                            alerts.newAlerts.map(function(alert,index){
                                var station=JSON.stringify(alert.station);
                                var user=alert.user;
                                var alertElem="<a href='#'  class='list-group-item' data-toggle='alert-view' data-alertData='"+JSON.stringify(alert)+"' data-station='"+station+"'";
                                alertElem+=" data-sender='"+user.username+"'><i class='fa fa-bell' aria-hidden='true'></i>&nbsp;";
                                alertElem+="<strong>"+alert.emergency+"</strong>&nbsp; - alert #&nbsp;"+alert.id+"</a>";            
                                
                                $('#alerts').prepend(alertElem);
                                alertUser('New Message alert received # - '+alert.id);
                            });
                            getURL=rawURL+'/'+alerts.upperBound;
                            if(alerts.newAlerts.length!=0){
                                initAlerts();
                            }
                            
                        }
                    });
                },10000);
            });
    </script>
    <script src="{{URL::asset('js/emergency-handler.js')}}"></script>
@stop