@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card" style="border-top: 3px solid #75ad10;">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ url('images/user_logo.png') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{ $user->email }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings">
                                    @include('adminlte-templates::common.errors')
                                    @include('flash::message')
                                    {!! Form::model($user, ['route' => ['users.updateProfile', $user->id], 'method' => 'patch']) !!}
                                    <!-- Name Field -->
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Nom :', ['class' => 'required col-sm-2 col-form-label']) !!}

                                        <div class="col-sm-10">
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <!-- Email Field -->
                                    <div class="form-group row">
                                        {!! Form::label('email', 'Email :', ['class' => 'required col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <!-- Password Field -->
                                    <div class="form-group row">
                                        {!! Form::label('password_new', 'Mot de passe :', ['class' => 'col-sm-2 col-form-label']) !!}
                                        <div class="col-sm-10">
                                            {!! Form::text('password_new', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
