@extends('partials.app')
@section('content')
    <div class="container  pad-5" >	
        <div class="row">
                <div class="col-sm-12">
                        <hr style="border-color:#0087fdc7;border-width:thick;margin-bottom:4px;">
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <br>
                        <div class="col-sm-2">
                                <div class="panel panel-info tile animated pulse" data-view="{{URL('users')}}" title="Access users">
                                    <div class="panel-body">
                                        <div class="tile-icon">
                                            <i class="fa fa-users" aria-hidden="true"></i><br>
                                            <h4>Users</h4>
                                        </div>
                                    </div>
                                </div>
                        </div><!-- ./tile -->
                        <div class="col-sm-2">
                                <div class="panel panel-info tile animated pulse" data-view="{{URL('stations')}}" title="Access Stations">
                                    <div class="panel-body">
                                        <div class="tile-icon">
                                            <i class="fa fa-circle-o-notch" aria-hidden="true"></i><br>
                                            <h4>Stations</h4>
                                        </div>
                                    </div>
                                </div>
                        </div><!-- ./tile -->
                        <div class="col-sm-2">
                                <div class="panel panel-info tile animated pulse" data-view="{{URL('messages')}}" title="Access Messages">
                                    <div class="panel-body">
                                        <div class="tile-icon">
                                            <i class="fa fa-envelope" aria-hidden="true"></i><br>
                                            <h4>Messages</h4>
                                        </div>
                                    </div>
                                </div>
                        </div><!-- ./tile -->
                        <div class="col-sm-2">
                                <div class="panel panel-info tile animated pulse" data-view="{{URL('reports')}}" title="Access Reports">
                                    <div class="panel-body">
                                        <div class="tile-icon">
                                            <i class="fa fa-archive" aria-hidden="true"></i><br>
                                            <h4>Reports</h4>
                                        </div>
                                    </div>
                                </div>
                        </div><!-- ./tile -->
                        <div class="col-sm-4">
                                <div class="panel panel-info tile animated pulse" data-view="{{URL('emergency-unit')}}" title="Access Emergency Unit">
                                    <div class="panel-body">
                                        <div class="tile-icon">
                                            <i class="fa fa-bell" aria-hidden="true"></i><br>
                                            <h4>Emergency Unit</h4>
                                        </div>
                                    </div>
                                </div>
                        </div><!-- ./tile -->
                     
                    </div>      
                </div><!--  ./tiles -->
        </div><!-- ./row -->
        <div class="row">
            <div class="col-sm-12">
                <hr style="border-color:#0087fdc7;border-width:thick">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                
                <div class="panel panel-info">
                      <div class="panel-heading">
                            <h3 class="panel-title">Emergency Alerts</h3>
                      </div>
                      
                      <div class="list-group">
                          @foreach($alerts as $alert)
                          <a href="{{URL('messages/view',$alert->id)}}" class="list-group-item">
                              <i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp;
                              {{ucfirst($alert->emergency)}} alert message
                              @if($alert->emergency=='hospital')
                              <span class="badge">
                                  <i class="fa fa-hospital-o" aria-hidden="true"></i>
                              </span>
                              @elseif($alert->emergency=='police')
                                    <span class="badge">
                                        <i class="fa fa-legal" aria-hidden="true"></i>
                                    </span>
                             @elseif($alert->emergency=='fire')
                                    <span class="badge">
                                        <i class="fa fa-fire"></i>
                                    </span>
                            @endif
                        </a>    
                          @endforeach
                      </div>
                      
                </div>
                
            </div>
        </div>
    </div><!-- ./container -->

@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            //set current username in navbar
            /**Handle events **/

            //handle tile click function
             $('.tile').on('click',function(){
                var targetWin=$(this).attr('data-view');
                window.location.assign(targetWin);
            });
            

        });
    </script>
@stop
