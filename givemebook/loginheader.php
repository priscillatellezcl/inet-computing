<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<body>

<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Give me Book</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li
              <?php if(!isset($_GET['mybook'])){ echo "class=active";} ?>
              ><a href="index.php">Most Recent</a></li>
              <li
              
              <?php if(isset($_GET['mybook'])){ echo "class=active";} ?>
              
              ><a href="index.php?mybook=1">My book</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Category<b class="caret"></b></a>
    				<ul class="dropdown-menu">
      <!-- links -->
    				</ul>
  				</li>
              <li class="span1 offset3"></li>

              <li class="nav actions"><a class="" href="index.php?sign=0">SignOut</a></li>

            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</body>