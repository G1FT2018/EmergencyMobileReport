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
                          <a href="#" class="list-group-item">
                              <i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp;
                              Hospital alert message
                              <span class="badge">
                                  <i class="fa fa-hospital-o" aria-hidden="true"></i>
                              </span>
                          </a>
                          <a href="#" class="list-group-item">
                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp;
                                Fire alert message
                                <span class="badge">
                                    <i class="fa fa-fire"></i>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp;
                                Police Alert message
                                <span class="badge">
                                    <i class="fa fa-legal" aria-hidden="true"></i>
                                </span>
                            </a>
                     
                      </div>
                      
                </div>
                
            </div>
        </div>
    </div><!-- ./container -->
    <div class="modal fade" id="settings-win">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header custom-modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Account Settings</h4>
                    </div>
                    <div class="modal-body">
                        <p><b><i class="fa fa-key"></i>&nbsp;Update Password</b></p>
                        <hr style="margin-top:2px;margin-bottom:6px;">
                        
                        <form action="void:javascript();" id="upload-journal-form" method="POST" role="form">
                            <div class="form-group">
                                <label for="File">Old Password</label>
                                <input type="password" id="old_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="File">New Password</label>
                                <input type="password" id="old_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="File">Retype Password</label>
                                <input type="password" id="old_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- settings -win-->
@stop
@section('scripts')
    <script>
        $(document).ready(function(){
            //set current username in navbar
            var user='Fraganya';
            $('#user').text(user);

            /**Handle events **/

            //handle tile click function
             $('.tile').on('click',function(){
                var targetWin=$(this).attr('data-view');
                window.location.assign(targetWin);
            });
            

        });
    </script>
@stop
