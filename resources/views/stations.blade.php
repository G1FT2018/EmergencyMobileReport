@extends('partials.app')
@section('content')
    <div class="container  pad-5" >	
        <div class="row">
            <div class="col-sm-12">
                <h3>
                    <i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp; Stations
                </h3>
                <hr>
            </div>
        </div><!-- /.row -->
        <div class="row">
                <div class="col-sm-4">
                    <button type="button" class="btn btn-primary rad-0" data-target="#new-station-win" data-toggle="modal" style="width:49%;">
                         <i class="fa fa-plus"></i>&nbsp;Add Station
                    </button>
                    <button type="button" id="default-view-btn" class="btn btn-primary rad-0" style="width:49%;">
                        <i class="fa fa-refresh"></i>&nbsp;Default View
                    </button>
                    <br><br>
                    <form action="" method="POST" class="" role="form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="" data-toggle="station-search" placeholder="search station">
                        </div>
                    </form><!-- ./form -->
                    
                    
                    
                    <div class="list-group rad-0" id="stations">
                        @foreach($stations as $station)
                            <a href="#"  data-toggle="station-view" data-station-data="{{json_encode($station)}}" class="list-group-item">
                                    <i class="fa fa-circle-o" aria-hidden="true"></i>&nbsp;
                                    {{ucfirst($station->name)}}
                            </a>
                        @endforeach
                    </div><!-- /stations list-->
                    <div class="text-center pull-right" style="display:inline-block;">
                            {{$stations->links()}}
                        </div>
                </div><!-- ./col -1 -->
                <div class="col-sm-8 ">
                        <div class="row std-side-widget" id="no-station-panel">
                                <div class="col-sm-12 text-center" style="margin-top:100px;">
                                    <h4>
                                        <i class="fa fa-circle-o-notch" style="font-size:350%" aria-hidden="true"></i>
                                    </h4>
                                    <p>Please select a station</p>

                                </div>   
                            </div><!-- ./no user panel -->
                    
                            <div class="row std-side-widget active hidden" id="station-panel">
                                <div class="col-sm-4 ">
                                    <br><br>
                                    <div class="text-center">
                                        <i style="font-size:1000%" class="fa fa-circle-o-notch" aria-hidden="true"></i>
                                        <h4 id="v-station-name">

                                        </h4>
                                    </div>    
                                    <br>                                                              
                                </div>
                                <div class="col-sm-8">
                                        <div class="col-sm-12">
                                            <br><br>
                                                <div class="field">
                                                        <div class="field-label"><i class="fa fa-tags"></i>&nbsp;<b>Location</b></div>
                                                        <div class="field-value" id="v-station-location">N/A</div>
                                                </div>
                                                <div class="field">
                                                        <div class="field-label"><i class="fa fa-tags"></i>&nbsp;<b>Email</b></div>
                                                        <div class="field-value" id="v-station-phone">N/A</div>
                                                </div>
                                                
                                                <button type="button" class="btn btn-danger btn-block rad-0" data-target="#modify-station-win" data-toggle="station-update">
                                                    <i class="fa fa-cog"></i>&nbsp;Modify
                                                </button>
                                                
                                            </div>
    
                        </div>
                    </div>
                    
                </div>
            </div><!-- ./row -->
        
    </div><!-- ./container -->
   
        

    <div class="modal fade" id="new-station-win">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header custom-modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Station</h4>
                    </div>
                    <div class="modal-body">
                         
                        <form action="{{URL('stations/create')}}" id="upload-journal-form" method="POST" role="form">
                            <div class="form-group">
                                <label for="username">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="firstname">Phone</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                    <label for="firstname">Location</label>
                                    <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Latitude</label>
                                <input type="text" name="latitude"  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Longitude</label>
                                <input type="text" name="longitude"  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rad-0">
                                    Create
                                </button>
                                <button type="reset" class="btn btn-default rad-0">
                                    Clear
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- new user -win-->

        <div class="modal fade" id="modify-station-win">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header custom-modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modify Station</h4>
                        </div>
                        <div class="modal-body">
                             
                             <div role="tabpanel">
                                 <!-- Nav tabs -->
                                 <ul class="nav nav-tabs" role="tablist">
                                     <li role="presentation" class="active">
                                         <a href="#general" aria-controls="home" role="tab" data-toggle="tab">General</a>
                                     </li>
                                     <li role="presentation">
                                         <a href="#danger" aria-controls="tab" role="tab" data-toggle="tab">Danger</a>
                                     </li>
                                 </ul>
                             
                                 <!-- Tab panes -->
                                 <div class="tab-content">
                                     <div role="tabpanel" class="tab-pane active" id="general">
                                         <div class="pad-3" style="padding-top:5px;padding:4px;">
                                                <form action="{{URL('stations/update')}}"  method="POST" role="form">
                                                    <input type="hidden" id="u-station-id" name="id">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="u-station-name" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input type="text" name="phone" id="u-station-phone" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                            <label for="location">Location</label>
                                                            <input type="text" name="location" id="u-station-location" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="location">Latitude</label>
                                                        <input type="text" name="latitude" id="u-station-latitude" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="location">Longitude</label>
                                                        <input type="text" name="longitude" id="u-station-longitude" class="form-control" required>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary rad-0">
                                                            Update
                                                        </button>
                                                    </div> 
                                                </form>
                                            </div>
                                     </div><!-- general details -->
                                     <div role="tabpanel" class="tab-pane" id="danger">
                                        
                                        <div class="pad-3" style="padding-top:5px;">
                                            <form action="{{URL('stations/delete')}}" method="POST" class="form">
                                                <input type="hidden" id="d-station-id" name="id"> 
                                                <div class="alert alert-danger">
                                                        <strong>Delete Station!</strong>
                                                        <br>
                                                        Deleting&nbsp;<span id="d-station-name"></span>&nbsp;will remove this station from the system and 
                                                        it is irreversible.
                                                 </div>
                                                    
                                                <button type="submit" class="btn btn-danger rad-0">Delete</button>

                                            </form>
                                           
                                        </div>
                                        
                                     </div>
                                     <!-- danger tab -->
                                 </div>
                             </div>
                             
                           
                        </div>
                    </div>
                </div>
            </div><!-- modify user -win-->
    @stop
    @section('scripts')
    <script>
        var currentStation;
        $(document).ready(function(){
            //set current username in navbar
            var user='Fraganya';
            $('#user').text(user);

            $('[data-toggle="station-view"]').on('click',function(){
                stationData=JSON.parse($(this).attr('data-station-data'));
                currentStation=stationData;
                $('#v-station-name').text(stationData.name);
                $('#v-station-location').text(stationData.location);
                $('#v-station-phone').text(stationData.phone);
                $('#no-station-panel').addClass('hidden');
                $('#station-panel').removeClass('hidden');
            });

            $('[data-toggle="station-update"]').on('click',function(){
                $('#u-station-name').val(stationData.name);
                $('#u-station-location').val(stationData.location);
                $('#u-station-phone').val(stationData.phone);
                $('#u-station-id').val(stationData.id);
                $('#d-station-name').html("<strong>"+stationData.name+"</strong>");
                $('#d-station-id').val(stationData.id);
                $('#u-station-latitude').val(stationData.stationlatitude);
                $('#u-station-longitude').val(stationData.stationlongitude);
                $('#modify-station-win').modal('show');
            });

             $('#default-view-btn').on('click',function(){
                $('#no-station-panel').removeClass('hidden');
                $('#station-panel').addClass('hidden');
            })

        });
    </script>
   @stop

</body>
</html>