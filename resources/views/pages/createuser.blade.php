@extends('template')

@section('pageTitle', 'Selection-Committee - Create User')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Create New User</h3>
                        <hr>
                      </div>
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="firstname" required>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="lastname" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="email" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="verify" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" value="1" type="radio" name="role" id="admin" value="ERO">
                            <label class="form-check-label" id="ero" for="ero">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" checked value="2" type="radio" name="role" id="normal_user" value="normal user">
                            <label class="form-check-label" for="student">Normal User</label>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-user-plus"></i>
                                Create New User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

@endsection
