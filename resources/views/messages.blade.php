@extends('partials.app')
@section('content')

    <div class="container  pad-5" >	
        <div class="row">
            <div class="col-sm-12">
                <h3>
                    <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; Messages
                </h3>
                <hr>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <select name="" class="form-control rad-0" required="required" style="width:20%;display:inline-block;">
                        <option value="">-- Filter  by Responce --</option>
                        <option value="">All</option>
                        <option value="">Responded</option>
                        <option value="">Not Responded</option>
                </select>
                <select name="" class="form-control rad-0" required="required" style="width:20%;display:inline-block;">
                        <option value="">-- Filter by Time--</option>
                        <option value="">All</option>
                        <option value="">Today</option>
                        <option value="">This Month</option>
                        <option value="">This Year</option>
                </select>
            </div>
        </div>
        <div class="row">
                <div class="col-sm-12">
                    <div class="std-side-widget active " style="margin-top:5px;padding:5px;">
                        <table class="table table-striped" id="requests-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="padding-bottom:8px;">Msg #</th>
                                    <th style="padding-bottom:8px;">From</th>
                                    <th style="padding-bottom:8px;">Time</th>
                                    <th style="padding-bottom:8px;">Alert Type</th>
                                    <th style="padding-bottom:8px;">Station</th>
                                    <th style="padding-bottom:8px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                <tr>
                                    <td>{{$message->id}}</td>
                                    <td>{{$message->user->username}}</td>
                                    <td>{{$message->created_at}}</td>
                                    <td>{{$message->emergency}}</td>
                                    <td>
                                        {{($message->station) ? $message->station->name : 'N/A'}}
                                    </td>
                                    <td>
                                        <a href="{{URL('messages/view',$message->id)}}" target="__blank" class="btn btn-sm btn-primary" data-toggle="modal" title="view">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
              
                            </tbody>
                        </table>
                    </div>
                    <div>
                            <br>
                            {{$messages->links()}}
                    </div>
                    
                
                </div>
            </div>
    </div><!-- ./container -->
@stop
@section('scripts')


@stop

</body>
</html>