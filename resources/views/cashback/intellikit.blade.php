@extends('layouts.app')

@section('content')
<!-- <div class="main-content">
    <div class="container-fluid"> -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Add Intellikit Cashabck</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
		<form name="addintellikitcashback" id="addintellikitcashback" action="{{route('intellikitcashback')}}" method="POST">
			@csrf
		<div class="row">
			<div class="col-md-12">
				<div class="input-group" style="box-shadow: none;">
				<span>Rule For: <span class="text-danger">*</span> </span> &nbsp;&nbsp;&nbsp;
					<label for="rulefor1"> <input type="radio" name="rulefor" id="rulefor1" value="1"> Product</label>&nbsp;&nbsp;&nbsp;
					<label for="rulefor2"> <input type="radio" name="rulefor" id="rulefor2" value="2"> Intellikit</label>
				</div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Rule Name:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="rulename" id="rulename" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback On Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashoncoupon" id="cashoncoupon" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Out Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashoutcoupon" id="cashoutcoupon" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Validity Days:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashvaliddays" id="cashvaliddays" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Percentage:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashperc" id="cashperc" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback MaxAmount:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashmaxamnt" id="cashmaxamnt" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Min Purchase:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashminpurc" id="cashminpurc" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Intellikit 3 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit3monthssubscrboxno" id="intellikit3monthssubscrboxno" class="form-control">
					<option value="">select</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="intellikit3monthsboxisactive"> <input type="checkbox" name="intellikit3monthsboxisactive" id="intellikit3monthsboxisactive" value="" /> IsActive</label>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Intellikit 6 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit6monthssubscrboxno" id="intellikit6monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="intellikit6monthsboxisactive"> <input type="checkbox" name="intellikit6monthsboxisactive" id="intellikit6monthsboxisactive" value="" /> IsActive</label>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Intellikit 9 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit9monthssubscrboxno" id="intellikit9monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="intellikit9monthsboxisactive"> <input type="checkbox" name="intellikit9monthsboxisactive" id="intellikit9monthsboxisactive" value="" /> IsActive</label>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Intellikit 12 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit12monthssubscrboxno" id="intellikit12monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="intellikit12monthsboxisactive"> <input type="checkbox" name="intellikit12monthsboxisactive" id="intellikit12monthsboxisactive" value="" /> IsActive</label>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>EmailTemplateID:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="emailtemplateid" id="emailtemplateid" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback StartDate:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="date" name="cashstartdate" id="cashstartdate" value="" class="form-control" />
			</div>
			<div class="col-md-2">
				<span>Time:</span> 
				<select name="cashstarttimehr" id="cashstarttimehr">
					<option value="00">00</option>
					<option value="11">11</option>
				</select>
				<select name="cashstarttimemins" id="cashstarttimemins">
					<option value="00">00</option>
					<option value="11">11</option>
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback EndDate:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="date" name="cashenddate" id="cashenddate" value="" class="form-control" />
			</div>
			<div class="col-md-2">
				<span>Time:</span> 
				<select name="cashendtimehr" id="cashendtimehr">
					<option value="00">00</option>
					<option value="11">11</option>
				</select>
				<select name="cashendtimemins" id="cashendtimehrmins">
					<option value="00">00</option>
					<option value="11">11</option>
				</select>
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<label for="isactive"> <input type="checkbox" name="isactive" id="isactive" value="1"> IsActive</label>
			</div>
			
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>CreatedBy:</span>
			</div>
			<div class="col-md-4">
				<span>Rekha</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Created Date:</span>
			</div>
			<div class="col-md-4">
				<span>2021-01-28</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>ModifiedBy:</span>
			</div>
			<div class="col-md-4">
				<span>Rekha</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Modified Date:</span>
			</div>
			<div class="col-md-4">
				<span>2021-01-28</span>
			</div>
		</div>
		<div class="row form-group text-center">
			<div class="col-md-12">
				<input type="submit" value="Save Details" class="btn btn-primary btn-sm" />
			</div>
		</div>
		</form>
 </div>
</div>
<!--     </div>
</div> -->
@endsection