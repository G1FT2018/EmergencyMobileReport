@extends('partials.app')
 @section('content')
<div class="container  pad-5">
    <div class="row">
        <div class="col-sm-12">
            <h3>
                <i class="fa fa-users" aria-hidden="true"></i>&nbsp; Users
            </h3>
            <hr>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-sm-4">
            <button type="button" class="btn btn-primary rad-0" data-target="#new-user-win" data-toggle="modal" style="width:49%;">
                <i class="fa fa-user-plus"></i>&nbsp;Add User
            </button>
            <button type="button" id="default-view-btn" class="btn btn-primary rad-0" style="width:49%;">
                <i class="fa fa-refresh"></i>&nbsp;Default View
            </button>
            <br>
            <br>
            <form action="" method="POST" class="" role="form">
                <div class="form-group">
                    <input type="text" class="form-control"  data-toggle="user-search" placeholder="filter user">
                </div>
            </form>
            <!-- ./form -->



            <div class="list-group rad-0" id="users">
                @foreach($users as $user)
                    <a href="#" data-toggle="user-view" data-user-data="{{json_encode($user)}}" class="list-group-item">
                        <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                        {{ucfirst($user->username)}}
                    </a>
                @endforeach
            </div>
            <!-- /users list-->
            <div class="text-center pull-right" style="display:inline-block;">
                {{$users->links()}}
            </div>
        </div>
        <!-- ./col -1 -->
        <div class="col-sm-8 ">
            <div class="row std-side-widget" id="no-user-panel">
                <div class="col-sm-12 text-center" style="margin-top:100px;">
                    <h4>
                        <i class="fa fa-user" style="font-size:350%" aria-hidden="true"></i>
                    </h4>
                    <p>Please select a user</p>

                </div>
            </div>
            <!-- ./no user panel -->

            <div class="row std-side-widget active hidden" id="user-panel">
                <div class="col-sm-6 ">
                    <div class="text-center">
                        <i style="font-size:1000%" class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <br>
                    <div class="col-sm-12">
                        <div class="field">
                            <div class="field-label">
                                <i class="fa fa-tags"></i>&nbsp;
                                <b>Uername</b>
                            </div>
                            <div class="field-value" id="v-username"></div>
                        </div>
                        <div class="field">
                            <div class="field-label">
                                <i class="fa fa-tags"></i>&nbsp;
                                <b>Type</b>
                            </div>
                            <div class="field-value" id="v-type">Standard User</div>
                        </div>
                        <div class="field">
                            <div class="field-label">
                                <i class="fa fa-tags"></i>&nbsp;
                                <b>Email</b>
                            </div>
                            <div class="field-value" id="v-email">user.pap</div>
                        </div>
                    </div>
                   

                </div>
                <div class="col-sm-6">
                    <br><br>
                        <button type="button" class="btn btn-danger btn-block rad-0"  data-toggle="user-update">
                                <i class="fa fa-cog"></i>&nbsp;Modify User
                        </button>
                        <a type="button" class="btn btn-danger btn-block rad-0">
                                <i class="fa fa-envelope"></i>&nbsp;View Messages
                        </a>
                </div>
                
            </div>

        </div>
    </div>
    <!-- ./row -->

</div>
<!-- ./container -->


<div class="modal fade" id="new-user-win">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New User</h4>
            </div>
            <div class="modal-body">

                <form action="{{URL('register')}}"  method="POST" role="form">
                    {{csrf_field()}}
                    <input type="hidden" name="web_access" value="true">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" required="required">
                            <option value="administrator">Administrator</option>
                            <option value="standard">Standard</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
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
</div>
<!-- new user -win-->

<div class="modal fade" id="modify-user-win">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modify User</h4>
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
                                <form action="{{URL('users/update')}}"  method="POST" role="form">
                                    <input type="hidden" id="u-user-id" name="id">
                                    <div class="form-group">
                                        <label for="firstname">Type</label>
                                        <select name="type" class="form-control" required="required">
                                            <option value="administrator">Administrator</option>
                                            <option value="standard">Standard</option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary rad-0">
                                            Update
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- general details -->
                        <div role="tabpanel" class="tab-pane" id="danger">
                            <form action="{{URL('users/delete')}}"  method="POST" role="form">
                                <input type="hidden" id="d-user-id" name="id">
                                <div class="pad-3" style="padding-top:5px;">
                                    <div class="alert alert-danger">
                                        <strong>Delete User!</strong>
                                        <br> Deleting
                                        <span id="d-username"></span> will remove this user from the system and it is irreversible.
                                    </div>

                                    <button type="submit" class="btn btn-danger rad-0">Delete</button>
                                </div>
                            </form>
                        </div>
                        <!-- danger tab -->
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
<!-- modify user -win-->
@stop
@section('scripts')
<script>
    $(document).ready(function () {
        //set current username in navbar
        var currentUser;
        $('[data-toggle="user-view"]').on('click', function () {
            user=JSON.parse($(this).attr('data-user-data'));
            currentUser=user;
            //set user attr
            $('#v-username').text(user.username);
            $('#v-email').text(user.email);
            $('#v-type').text(user.type)
            $('#no-user-panel').addClass('hidden');
            $('#user-panel').removeClass('hidden');
        });

        $('[data-toggle="user-update"]').on('click',function(){
            $('#u-user-id').val(currentUser.id);
            $('#d-username').html("<strong>"+currentUser.username+"</strong>");
            $('#d-user-id').val(currentUser.id);

            $('#modify-user-win').modal('show');
        });
        $('#default-view-btn').on('click', function () {
            $('#no-user-panel').removeClass('hidden');
            $('#user-panel').addClass('hidden');
        })
    });
</script>
@stop