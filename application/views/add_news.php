<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add News</title>

    <link href="<?php echo base_url(); ?>asset/bootstrap/css/bootswatch.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/app.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/images/hwi_favicon_logo.png" rel="shortcut icon" type="image/x-icon">
    <link href="<?php echo base_url(); ?>asset/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?=base_url()?>asset/images/logo.png">    
</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">C O I N   H U N T</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?=base_url()?>index.php/feedback/view">Feedback</a></li>
          <li><a href="<?=base_url()?>index.php/news/view">View List</a></li>
          <li><a href="<?=base_url()?>index.php/user/logout">Logout</a></li>
        </ul>
      </div>
    </nav>

	<div class="container">
        <h3>Add News</h3>
        <hr>
		<div class="col-md-6">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=base_url()?>index.php/news/add_details">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" required="">
                </div>

                <div class="form-group">
                    <label for="banner">Banner</label>
                    <input type="file" name="userfile" id="banner" required="">
                </div>

                <div class="form-group">
                    <label for="source">Source</label>
                    <input type="text" name="source" class="form-control" id="source" placeholder="Source" required="">
                </div>

                <div class="form-group">
                    <label for="source_link">Source Link</label>
                    <input type="text" name="source_link" class="form-control" id="source_link" placeholder="Source Link" required="">
                </div>

                <div class="form-group">
                    <label for="body">Body/Message</label>
                    <textarea id="body" name="body" class="form-control" required=""></textarea>
                </div>

              <!--   <div class="form-group">
                    <label for="body_image">Body Image</label>
                    <input type="file" name="userfile2" id="body_image" required="">
                </div> -->

                <div class="form-group">
                    <label for="ico">ICO</label><br>
                    <input type="radio" name="ico" id="ico1" value="1"> Yes &nbsp;&nbsp;
                    <input type="radio" name="ico" id="ico2" value="0" checked="checked"> No
                </div>

                <div class="form-group">
                    <label for="ico">Airdrop/Bounty</label><br>
                    <input type="radio" name="airdrop" id="airdrop1" value="1"> Yes &nbsp;&nbsp;
                    <input type="radio" name="airdrop" id="airdrop2" value="0" checked="checked"> No
                </div>

                <div class="form-group">
                    <label for="trending">Trending</label><br>
                    <input type="radio" name="trending" id="trending1" value="1"> Yes &nbsp;&nbsp;
                    <input type="radio" name="trending" id="trending2" value="0" checked="checked"> No
                </div>

                <div class="form-group">
                    <label for="source">Tag</label>
                    <input type="text" name="tags" class="form-control" id="tags" placeholder="Tag" required="">
                </div>

                <button type="submit" class="btn btn-warning pull-right">Submit</button>
            </form>
        </div>
	</div>

    <script src="<?php echo base_url(); ?>asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>