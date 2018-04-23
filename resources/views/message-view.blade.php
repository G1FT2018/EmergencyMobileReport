@extends('partials.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="col-sm-12">
                    <h3>
                        <i class="fa fa-bell" aria-hidden="true"></i>&nbsp; Emergency Alert View 
                    </h3>
                    <hr>
                </div>
        <div class="col-sm-12">
                <div class="row std-side-widget active" id="alert-panel" style="padding:5px;">
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
                                    <div class="field-value" id="v-sender-name">{{$message->user->username}}</div>
                                </div>
                                <div class="field">
                                    <div class="field-label">
                                        <i class="fa fa-tags"></i>&nbsp;
                                        <b>Time</b>
                                    </div>
                                    <div class="field-value" id="v-alert-time">
                                        {{$message->created_at}}
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="field-label">
                                        <i class="fa fa-tags"></i>&nbsp;
                                        <b>Emergency</b>
                                    </div>
                                    <div class="field-value" id="v-alert-type">{{$message->emergency}}</div>
                                </div>
                                <div class="field">
                                        <div class="field-label">
                                            <i class="fa fa-tags"></i>&nbsp;
                                            <b>Closest Station</b>
                                        </div>
                                        <div class="field-value" id="v-alert-station">{{$message->station->name}}</div>
                                </div>
                                <div class="field">
                                        <div class="field-label">
                                            <i class="fa fa-tags"></i>&nbsp;
                                            <b>Station Contact #</b>
                                        </div>
                                        <div class="field-value" id="v-alert-phone">{{$message->station->phone}}</div>
                                </div>
                                <div class="field">
                                        <div class="field-label">
                                            <i class="fa fa-tags"></i>&nbsp;
                                            <b>Status</b>
                                        </div>
                                        <div class="field-value" id="v-alert-phone">{{($message->reponded!=0) ? 'Responded' : 'Unresponsed'}}</div>
                                </div>
    
                            </div>
    
                        </div>
                        <div class="col-sm-8 p-5" >
                              <iframe style="width:100%;height:500px;;" src="{{URL('map-view',$message->coordinates->latitude.'/'.$message->coordinates->longitude)}}">
    
                              </iframe>
    
                        </div>
                    </div>
        </div>
    </div>

</div>

@stop
@section('scripts')

@stop