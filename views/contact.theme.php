<?= $name ?>
<form class="row g-3" action="contact" method="post">
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="text" name="email" class="form-control">
  </div>
  <div class="col-md-6">
    <label  class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="col-6">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name" >
  </div>
  
  <div class="col-md-6">
    <label class="form-label">City</label>
    <input type="text" class="form-control" name="city">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>