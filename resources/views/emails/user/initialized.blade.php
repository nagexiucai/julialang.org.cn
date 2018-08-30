@extends('layouts.app')

@section('title')
    Your account has been initialized
@stop

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">

                    <h3 class="text-center">
                        <span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Your account has been initialized
                    </h3>
                    <hr>

                    <div class="notification-list">
                        Your account has been initialized, please login to reset your password.
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop