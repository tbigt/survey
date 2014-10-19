  <div class="bg-full bg-1"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="login-pane">
          <?php if(isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger text-center" role="alert">
              <?php foreach($errors as $error): ?>
                <li>
                  <?php echo $error; ?>
                </li>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <h4 class="text-center">
            <span class="glyphicon glyphicon-user"></span>
            Create Username &amp; Password
          </h4>
          <form role="form" method="post" action="signup">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="signup-email" value="<?php echo ((isset($_POST["signup-email"])) ? $_POST["signup-email"] : ""); ?>">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Password" name="signup-password">
            </div>
            <button type="submit" class="btn btn-default" value="signup-submit">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>