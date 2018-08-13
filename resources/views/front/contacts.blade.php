@extends('layouts.front')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Contact Us') }}
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                        <div class="row">
                                <div class="col-md-5">

                                    <form action="{{ route('contacts') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="full_name"> {{ __('Full Name') }}</label>
                                            <input class="form-control" id="full_name" name="full_name" type="text" value="{{ old('fullname') }}">
                                            @if($errors->has('full_name'))
                                            <div class="alert-danger">{{ $errors->first('full_name') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="email"> {{ __('Email') }}</label>
                                            <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}">
                                            @if($errors->has('email'))
                                                <div class="alert-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="message"> {{ __('Message') }}</label>
                                            <textarea rows="5" class="form-control" id="message" name="message" type="text">
                                                {{ old('message') }}
                                            </textarea>
                                            @if($errors->has('message'))
                                                <div class="alert-danger">{{ $errors->first('message') }}</div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input class="btn btn-success" name="submit_message" type="submit" value="{{ __('Send') }}">
                                        </div>

                                    </form>

                                </div>

                                <div class="col-md-7">
                                    <p style="margin-top: 25px;">
                                        Laisves al. 31a, Kaunas
                                        <br>
                                        HappSpace
                                    </p>

                                    <p>
                                        Gera vieta zemelapiui.
                                    </p>

                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection