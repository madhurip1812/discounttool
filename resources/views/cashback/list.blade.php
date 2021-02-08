@extends('layouts.app')

@section('content')
<!-- <div class="main-content">
    <div class="container-fluid"> -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">List Cashabck</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
		<form name="listcashback" id="listcashback" action="{{route('listcashback')}}" method="POST">
			@csrf
		<div class="row">
			<div class="col-md-3">
                <span>ID</span>
                <input type="text" name="id" id="id" value="" class="form-control" placeholder="Enter comma separated ids" />
            </div>
            <div class="col-md-3">
                <span>Coupon</span>
                <input type="text" name="coupon" id="coupon" value="" class="form-control" placeholder="Enter Coupon Code" />
            </div>
            <div class="col-md-3">
                <span>Start Date</span>
                <input type="date" name="startdate" id="startdate" value="" class="form-control" placeholder="Enter Start Date" />
            </div>
            <div class="col-md-3">
                <span>End Date</span>
                <input type="date" name="enddate" id="enddate" value="" class="form-control" placeholder="Enter End Date" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <span>Created from Date</span>
                <input type="date" name="createdfromdate" id="createdfromdate" value="" class="form-control" placeholder="Enter Created from Date" />
            </div>
            <div class="col-md-3">
                <span>Created to Date</span>
                <input type="date" name="createdtodate" id="createdtodate" value="" class="form-control" placeholder="Enter Created to Date" />
            </div>
            <div class="col-md-2">
                <input type="submit" value="Show" class="btn btn-primary btn-lg" style="margin: 11px 0 0 0;" />
            </div>
        </div>
    </form>
</div>
</div>
@endsection