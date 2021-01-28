@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Weekly Overview</h3>
            </div>
            <div class="panel-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <b>Welcome {{ session('name') }} ! </b>
            </div>
        </div>
    </div>
</div>
@endsection
