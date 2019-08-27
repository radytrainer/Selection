@extends('layouts.app')

@section('pageTitle', 'Selection-Committee - Login')

@section('content')



<div class="container">
   <div class="row justify-content-center mt-5">
       <div class="col-md-4">

           <div class="card">

                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <img src="{{url('../storage/app/public/img/logo.png')}}" class="p-3" style="width: 300px;" alt="logo">
                        <hr>

                        @if (Auth::check())

                            <h4 class="text-center">You are logged in!!</h4>
                            <a href="{{route('candidates.index')}}" class="btn btn-primary mt-5 mb-4 btn-block">
                                Go to Home page
                            </a>

                        @else
                            <div class="form-group">
                                <input id="email" type="email" placeholder="Email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" placeholder="Password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group mb-0">

                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>

                                <hr>

                            </div>

                        @endif

                    </form>

               </div>
           </div>
       </div>
   </div>
</div>

@endsection
