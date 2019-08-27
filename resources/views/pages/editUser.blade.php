@extends('template')

@section('content')

@section('pageTitle', 'Selection-Committee - Edit user')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Edit a user</h2></div>

                <div class="card-body">

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        
                        @method('PUT')
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="fname">@lang('First Name')</label>
                            <input type="text" class="form-control" id="fname" name="firstname" value="{{ $user->firstname }}">
                        </div>

                        <div class="form-group">
                            <label for="lname">@lang('Last Name')</label>
                            <input type="text" class="form-control" id="name" name="lastname" value="{{ $user->lastname }}">
                        </div>

                        <div class="form-group">
                            <label for="email">@lang('Email')</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="roles[]">User Role: </label>
                            @foreach ($roles as $role)
                                @if ($role->id == $user->role_id)
                                    <label class="radio-inline">
                                        <input type="radio" value="{{ $role->id }}" name="roles" checked> {{$role->name}}
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        <input type="radio" value="{{ $role->id }}" name="roles"> {{$role->name}}
                                    </label>
                                @endif
                            @endforeach
                        </div>

                        <input type="submit" class="btn btn-primary" value="Save" />

                        <a href="{{url('/users')}}" class="btn btn-danger">Back</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

