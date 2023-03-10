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
                <h5 class="mb-0">Teachers</h5>
                <button class="btn btn-xs btn-warning" onclick="addNewDrawer2()">Add</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="commonListBody" style="min-height: 100px" id="loaded_info">

                </div>
            </div>
            <div class="commonListPaginate">

            </div>
        </div>
    </div>

    <div class="insert_drawer_full_page" onclick="hideAddNewDrawer()">
        <div class="insert_drawer" onclick="dontHideAddNewDrawer(event)">
            <div class="row d-flex justify-content-center">
                <div class="col-11">
                    <style>
                        .form-group{
                            margin-bottom: 0;
                        }
                    </style>
                    <form action="{{ route('teacher.store') }}" class="form_submit">
                        <input type="hidden" name="row_id" id="row_id">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" id="name_form">
                        </div>
                        <div class="form-group">
                            <label for="">ID</label>
                            <input type="text" class="form-control" name="code" id="code_form">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" id="email_form">
                        </div>
                        <div class="form-group">
                            <label for="">Designation</label>
                            <select name="designation" id="designation_form" class="form-control select_2">
                                @foreach (getTeacherDesignation() as $key=>$d)
                                    <option value="{{ $key }}">{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="mobile_form">
                        </div>
                        <div class="form-group password_body">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.common')
@endsection


@section('script')
    <script>

        function addNewDrawer2(){

            $('.password_body').show();
            addNewDrawer();
        }

        let ajaxUrl = "{{ route('teacher.index') }}";
        let ajaxData = {};
        $(document).ready(function(){
            loadData();

            console.log("pppppppppppppp");
        });

        function loadData(){

            console.log("here");
            hideAddNewDrawer();
            getLoadingStatus();
            ajaxData = {};
            customAjaxCall(function(res){
                $('.commonListBody').html(res.body);
                $('.commonListPaginate').html(res.paginate);
                closeSweetAlert();
            }, 'GET', ajaxUrl, ajaxData)
        }

        function edit(id){
            $('.password_body').hide();
            getLoadingStatus();
            customAjaxCall(function(res){
                addNewDrawer();
                $('#row_id').val(res.info.id);
                $('#name_form').val(res.info.name);
                $('#code_form').val(res.info.code);
                $('#email_form').val(res.info.email);
                $('#designation_form').val(res.info.designation).trigger('change');
                $('#mobile_form').val(res.info.mobile);
                closeSweetAlert();
            }, 'get', "{{ route('teacher.edit') }}", {id});
        }
    </script>

@endsection
