<div class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-section">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo getNavBrand("admin/dashboard"); ?>
      <p class="navbar-text">Signed in as <?php echo $user["email"]; ?></p>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-section">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>admin/logout">Logout</a></li>
      </ul>
    </div>
  </div>
</div>