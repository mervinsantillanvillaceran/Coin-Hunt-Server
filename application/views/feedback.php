<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feedback</title>

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
          <li><a href="<?=base_url()?>index.php/news/add">Add News</a></li>
          <li><a href="<?=base_url()?>index.php/news/view">View List</a></li>
          <li><a href="<?=base_url()?>index.php/user/logout">Logout</a></li>
        </ul>
      </div>
    </nav>

	<div class="container">
    <div class="col-md-12">
      <div class="card card-outline-danger">
        <div class="card-block">
          <div class="col-md-12">
            <h4 class="card-title">Feedback</h4>
            <h6 class="card-subtitle mb-2 text-muted">List of all user's feedback.</h6> 
          </div>  
          <!-- <div class="col-md-12" id="search-div">
            <div class="col-md-3 pull-right" id="search-bar">
              <input type="text" name="search" id="search" placeholder="Search" class="form-control">
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="col-md-12 table-responsive">
              <table id="feedback" class="table table-striped table-hover" cellspacing="0">
                <thead >
                  <th width="15%">NAME</th>
                  <th width="15%">EMAIL</th>
                  <th width="10%">SUBJECT</th>  
                  <th width="10%">MESSAGE</th>
                </thead>
                <tbody id='feedback-table'>
                  <tr>  
                    <td align="center" colspan="7">No records found.</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div id="pagination" class="pagination pull-right">
              
            </div>
          </div>  
        </div>
      </div>
    </div>
	</div>

  <script type="text/html" id="feedback-row-template">
    <tr>
      <td data-content='name'></td>
      <td data-content='email'></td>
      <td data-content='subject'></td>
      <td data-content='message'></td>
    </tr>
  </script>

  <script type="text/javascript" src="<?=base_url()?>asset/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>asset/js/jquery.loadTemplate.min.js"></script>
  <script src="<?php echo base_url(); ?>asset/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function get(page = 1){
      var search = $('#search').val();

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>index.php/feedback/get_feedbacks',
        dataType: 'json',
        data: {
          page : page,
        },
        success: function(result){
          console.log(result);
          if(result.list.length){
            $('#feedback-table').loadTemplate($('#feedback-row-template'), result.list);
            $('#pagination').html(result.pagination);
            $('.pagination a[href]').on("click", function(e){
              e.preventDefault();
              get($(this).attr('data-ci-pagination-page'));
            });
          }
          else{
            $('#feedback-table').html('<tr><td align="center" colspan="7">No records found.</td></tr>');
          }
        }
      });
    }

    $(document).ready(function(){
      get();
    });
  </script>
</body>
</html>