@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Company') }}</div>

                <div class="card-body">
                    @include('flash')
                    <form action="/company" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if(Session::get('success'))
                        <div class='alert alert-success'>
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        
                        @if(Session::get('fail'))
                        <div class='alert alert-danger'>
                            {{ Session::get('fail') }}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name <span class="text-danger">*</span> : </strong>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                                <span class="text-danger">
                                    @error('name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email : </strong>
                                    <input type="text" name="email" class="form-control" value="{{old('email')}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Website : </strong>
                                    <input type="text" name="website" class="form-control" value="{{old('website')}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Logo : </strong>
                                    <input type="file" name="logo" class="form-control" value="">
                                </div>
                                <span class="text-danger">
                                    @error('logo')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary save-btn">Save</button>
                                <a class="btn btn-secondary back-btn" href="/company">Go to list</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection