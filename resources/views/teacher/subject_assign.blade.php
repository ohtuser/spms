@extends('layouts.master')
@section('title', 'Teachers')
@section('content')
    <style>
        #loaded_info{
            height: calc(100vh - 245px)!important;
        }
    </style>
    <div class="card sina-card mt-0 mb-1">
        <div class="card-header card-header-s">
            <div class="d-flex justify-content-between">
                <h5 class="mb-0">Teacher Course Assign</h5>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            Search Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <label for="">Teacher's Name</label>
                                    <select name="teacher" id="teacher_filter" class="form-control select_2">
                                        @foreach ($teachers as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="">Trimester</label>
                                    <select name="trimester" id="trimester_filter" class="form-control select_2">
                                        @foreach ($trimesters as $t)
                                            <option {{ $t->id == currTrimester() ? 'selected' : '' }} value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="" class="d-block">&nbsp;</label>
                                    <button class="btn btn-sm btn-info" type="button" onclick="loadData()">Search</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="teacher_information">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            Assign Course
                        </div>
                        <div class="card-body">
                            <form action="{{ route('teacher.subject_assign_store') }}" class="form_submit">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="">Teacher's Name</label>
                                        <select name="teacher" id="teacher_store" class="form-control select_2">
                                            @foreach ($teachers as $t)
                                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label for="">Trimester</label>
                                        <select name="trimester" id="trimester_store" class="form-control select_2">
                                            @foreach ($trimesters as $t)
                                                <option {{ $t->id == currTrimester() ? 'selected' : '' }} value="{{ $t->id }}">{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Course</th>
                                                    <th>Batch</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="subject" id="subject" class="form-control select_2" style="width: 100%">
                                                            @foreach ($subjects as $t)
                                                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="batch" id="batch" class="form-control select_2" style="width: 100%">
                                                            @foreach ($batches as $t)
                                                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-sm btn-warning">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.common')
@endsection


@section('script')
    <script>

        let ajaxUrl = "{{ route('teacher.assigned_subject') }}";
        let ajaxData = {};
        $(document).ready(function(){
            // loadData();
        });

        function loadData(){

            let teacher = $('#teacher_filter').val();
            let trimester = $('#trimester_filter').val();
            ajaxData = {teacher, trimester};
            customAjaxCall(function(res){
                $('.teacher_information').html(res.html);
                closeSweetAlert();
            }, 'GET', ajaxUrl, ajaxData)
        }
    </script>

@endsection
