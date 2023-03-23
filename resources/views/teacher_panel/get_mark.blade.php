@extends('layouts.master')
@section('title', 'Teachers')
@section('content')
    <style>
        /* #loaded_info{
            height: calc(100vh - 245px)!important;
        } */
        table th,table td{
            border: 1px solid #000!important;
        }
        table{
            border-collapse: collapse;
        }
    </style>
    <div class="card sina-card mt-0 mb-1">
        <div class="card-header card-header-s">
            <div class="d-flex justify-content-between">
                <h5 class="mb-0">Mark Of {{ $subject->name }} ({{ $subject->code }})</h5>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Trimester</th>
                                    <th>Batch</th>
                                    @foreach (getMarkDistribution($subject->mark_distribution) as $gm)
                                        <th>{{ $gm }}</th>
                                    @endforeach
                                    <th>Total</th>
                                </tr>
                            </thead>
                            @foreach ($students as $key=>$s)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $s->getStudent->name }}</td>
                                    <td>{{ $s->getStudent->code }}</td>
                                    <td>{{ $trimester->name }}</td>
                                    <td>{{ $s->getStudent->getBatch->name ?? '' }}</td>
                                    @php
                                        $total = 0;
                                        $info = $marks->where('student_id', $s->student)->first();
                                    @endphp
                                    @foreach (getMarkDistribution($subject->mark_distribution) as $key=>$gm)
                                        @php
                                            $cls = 'cr'.$key ;
                                            $m=$info ? $info->$cls: 0;
                                            $total+=$m;
                                        @endphp
                                        <td>{{ $m }}</td>
                                    @endforeach
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <button class="btn btn-sm btn-success">Save</button>
                    </form>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    @include('layouts.common')
@endsection


@section('script')
    <script>
    </script>
@endsection
