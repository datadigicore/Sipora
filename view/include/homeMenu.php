  <nav class='navbar navbar-default'>
    <div class='container-fluid'>
      <div class='navbar-header'>
        <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
          <span class='sr-only'>Toggle navigation</span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
        </button>
      </div>
      <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
        <ul class='nav navbar-nav'>
          <li <?php if ($link[0] == 'home'){ echo "class='active'";}?>><a href="<?php echo $base_url; ?>home"><b>Home</b></a></li>
          <!-- <li <?php if ($link[0] == 'review'){ echo "class='active'";}?>><a href="<?php echo $base_url; ?>review"><b>Rekapitulasi</b></a></li> -->
          <!-- <li <?php if ($link[0] == 'dekon'){ echo "class='active'";}?>><a href="<?php echo $base_url; ?>dekon"><b>Evaluasi Dekon</b></a></li> -->
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li <?php if ($link[0] == 'login'){ echo "class='active'";}?>><a href="<?php echo $base_url; ?>login"><b><i class='fa fa-user'></i> Login</b></a></li>
        </ul>
      </div>
    </div>
  </nav>