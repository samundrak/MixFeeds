<form class="form-horizontal">
<fieldset>


<!-- Form Name -->
<legend>Contact Form</legend>
{{ Session::set('user','sam')}}
{{ Session::get('user')}}
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Name</label>  
  <div class="col-md-4">
	{!! Form::text('name', null, ['class' => 'form-control','ng-model'=>"name"]) !!}
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Email</label>  
  <div class="col-md-4">
	{!! Form::text('name', null, ['class' => 'form-control','ng-model'=>"email"]) !!}
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Address</label>  
  <div class="col-md-4">
	{!! Form::text('name', null, ['class' => 'form-control','ng-model'=>"address"]) !!}
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button id="" name="" ng-click="contactMe()" class="btn btn-primary">Save</button>
  </div>
</div>

</fieldset>
</form>
