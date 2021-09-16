@extends('Layout.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $totalcourse }}</h5>
                    <p class="card-text">Course</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $totalservice }}</h5>
                    <p class="card-text">Service</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $totalvisitor }}</h5>
                    <p class="card-text">Visitor</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
