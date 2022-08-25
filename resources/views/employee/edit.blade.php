@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit a employee') }}</div>

                <div class="card-body">
                    
                    <form action="/employee/{{ $employee->id }}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
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
                                    <strong>First Name <span class="text-danger">*</span> : </strong>
                                    <input type="text" name="first_name" class="form-control" value="{{old('first_name',$employee->first_name)}}">
                                </div>
                                <span class="text-danger">
                                    @error('first_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Last Name <span class="text-danger">*</span> : </strong>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name',$employee->last_name)}}">
                                </div>
                                <span class="text-danger">
                                    @error('last_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Company : </strong>
                                    <select name="company_id" class="form-control">
                                        <option value="">Please select a company</option>                                        
                                        @foreach ($companies as $company)

                                        <option value="{{ $company->id }}" {{old ('company_id') == $company->id ? 'selected' : ''}} {{ $employee->company_id == $company->id ? 'selected' : '' }}>{{$company['name']}}</option>

                                        @endforeach                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email : </strong>
                                    <input type="text" name="email" class="form-control" value="{{old('email',$employee->email)}}">
                                </div>
                                <span class="text-danger">
                                @error('email')
                                {{ $message }}
                                @enderror
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Phone : </strong>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone',$employee->phone)}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary save-btn">Update</button>
                                <a class="btn btn-secondary back-btn" href="/employee">Go to list</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection