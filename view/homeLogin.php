  <div class="container-fluid">
    <div class="main">        
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="content-box">
            <div class="content-box-header dark-green">
              LOGIN
            </div>
            <div class="content-box-body">
              <?php include "include/homeAlert.php" ?>
              <form class="form-horizontal" id='loginForm' method='POST' action='<?php echo $base_url;?>process/login'>
                <div class="form-group">
                  <label for="username" class="col-sm-3 control-label">Username</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Login</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> <!-- end of row -->
    </div> <!-- end of main class -->
    <div class="footer">Powered By BBSDM Team : <b><a href='<?php echo $base_content ?>'>Susunan Redaksi</a></b> </div>
  </div><!-- end of container -->
</body>
</html>