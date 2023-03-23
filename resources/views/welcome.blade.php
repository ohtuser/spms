@extends('layouts.master')
@section('title', 'Welcome')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Dashboard</h1>
            </div>
        </div>
        <div class="col-12 text-center">
            <div class="row">
                <div class="col-2">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">Curr. Trimester</h5>
                        </div>
                        <div class="card-body">
                            {{ $trimester->name ?? '' }}
                        </div>
                    </div>
                </div>
                @if(user_info()->user_type == 1)
                    <div class="col-2">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h5 class="text-white mb-0">Total Batch</h5>
                            </div>
                            <div class="card-body">
                                {{ $batches ?? '' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-header bg-danger">
                                <h5 class="text-white mb-0">Total Teacher</h5>
                            </div>
                            <div class="card-body">
                                {{ $teacher ?? '' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white mb-0">Total Student</h5>
                            </div>
                            <div class="card-body">
                                {{ $student ?? '' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h5 class="text-white mb-0">Total Courses</h5>
                            </div>
                            <div class="card-body">
                                {{ $subject ?? '' }}
                            </div>
                        </div>
                    </div>
                @else


                @endif
            </div>
        </div>
    </div>
</div>

@endsection
