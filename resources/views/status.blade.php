@extends('partials.app')
@section('content')
    <div class="container  pad-5" >	
        <div class="row">
            <div class="col-sm-12">
                <h3>
                    <i class="fa fa-hashtag" aria-hidden="true"></i>&nbsp; Request Status
                </h3>
                <hr>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="well well-sm">
                    <p>
                        The system responded with<br>
                        <code>{{$message}}</code>
                    </p>
                </div>
            </div>
            <div class="col-sm-12">
                   <a href="{{URL($back_page)}}" class="btn btn-default btn-sm">Go Back</a>
            </div>
        </div>
        
    </div><!-- ./container -->

@stop
@section('scripts')

@stop