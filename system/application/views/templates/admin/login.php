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
            Login
          </h4>
          <form role="form" method="post" action="login">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="login-email" value="<?php echo ((isset($_POST["login-email"])) ? $_POST["login-email"] : ""); ?>">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Password" name="login-password">
            </div>
            <button type="submit" class="btn btn-default" value="login-submit">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>