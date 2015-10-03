<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Contact Form</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Name</label>  
  <div class="col-md-4">
  <input required id="textinput" ng-model="name" name="textinput" type="text" placeholder="Your Username" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Email</label>  
  <div class="col-md-4">
  <input required id="textinput" ng-model="email" name="textinput" type="text" placeholder="Your email" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Address</label>  
  <div class="col-md-4">
  <input  required id="textinput" ng-model="address" name="textinput" type="text" placeholder="Your Address" class="form-control input-md">
    
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
