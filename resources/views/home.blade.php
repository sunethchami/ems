@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <div class="row">
                    <div class="col-sm">
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title"><a href="/company">Companies</a></h4>
                                <p class="card-text"><h1>{{$company_count}}</h1></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">

                            <div class="card-body">
                                <h4 class="card-title"><a href="/employee">Employees</a></h4>
                                <p class="card-text"><h1>{{$employee_count}}</h1></p>
                            </div>
                        </div>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
