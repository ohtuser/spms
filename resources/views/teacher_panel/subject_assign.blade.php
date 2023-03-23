@extends('layouts.master')
@section('title', 'Welcome')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Assigned Courses</h1>
            </div>
        </div>
        <div class="col-12 text-center">
            <div class="row">
                @foreach ($infos as $i)
                    <div class="col-2">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h5 class="text-white mb-0">{{ $i->getBatch->name }}</h5>
                            </div>
                            <div class="card-body" style="height: 100px; overflow: hidden">
                                {{ $i->getSubject->name }}
                            </div>
                            <div class="d-flex align-items-center text-center justify-content-center mb-1">
                                <a href="{{ route('teacher.teacher.set_mark', ['batch'=>$i->batch, 'subject'=>$i->subject]) }}" class="btn btn-sm btn-warning">Set Mark</a>
                                <a href="{{ route('teacher.teacher.get_mark', ['batch'=>$i->batch, 'subject'=>$i->subject]) }}" class="btn btn-sm btn-info">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
