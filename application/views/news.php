<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>News</title>

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
          <li><a href="<?=base_url()?>index.php/news/add">Add News</a></li>
          <li><a href="<?=base_url()?>index.php/user/logout">Logout</a></li>
        </ul>
      </div>
    </nav>

	<div class="container">
    <div class="col-md-12">
      <div class="card card-outline-danger">
        <div class="card-block">
          <div class="col-md-12">
            <h4 class="card-title">News</h4>
            <h6 class="card-subtitle mb-2 text-muted">List of all cryptocurrency news.</h6> 
          </div>  
          <!-- <div class="col-md-12" id="search-div">
            <div class="col-md-3 pull-right" id="search-bar">
              <input type="text" name="search" id="search" placeholder="Search" class="form-control">
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="col-md-12 table-responsive">
              <table id="news" class="table table-striped table-hover" cellspacing="0">
                <thead >
                  <th width="15%">TITLE</th>
                  <th width="15%">SOURCE</th>
                  <th width="10%">ICO</th>  
                  <th width="10%">Airdrop/Bounty</th>  
                  <th width="10%">TRENDING</th>  
                  <th width="10%">TAG</th>
                  <th></th>
                </thead>
                <tbody id='news-table'>
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

  <script type="text/html" id="news-row-template">
    <tr>
      <td data-content='title'></td>
      <td data-content='source'></td>
      <td data-content='is_ico'></td>
      <td data-content='is_airdrop'></td>
      <td data-content='trending'></td>
      <td data-content='tags'></td>
      <td data-content='action'></td>
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
        url: '<?php echo base_url();?>index.php/news/get_news',
        dataType: 'json',
        data: {
          page : page,
        },
        success: function(result){
          if(result.list.length){
            result.list.forEach(function(obj){
              obj.action = '<a class="btn btn-warning btn-sm" href="<?=base_url()?>index.php/news/edit/' + obj.id + '"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;' +
                        '<a class="btn btn-danger btn-sm delete-news"><i class="fa fa-trash"></i></a> ' +
                        '<a class="btn btn-danger btn-sm confirm-delete-news" style="display:none;" id="' + obj.id + '">CONFIRM</a>';

              obj.source = "<a href='" + obj.source_link + "' target='_blank' style='color:blue'>" + obj.source + "</a>";
            });

            $('#news-table').loadTemplate($('#news-row-template'), result.list);
            $('#pagination').html(result.pagination);
            $('.pagination a[href]').on("click", function(e){
              e.preventDefault();
              get($(this).attr('data-ci-pagination-page'));
            });

            $('.delete-news').on('click', function(e){
              e.preventDefault();
              $(this).next('.confirm-delete-news').toggle();
            });

            $('.confirm-delete-news').on('click', function(e){
              e.preventDefault();
              var id = $(this).attr('id');
              delete_news(id);
            }); 
          }
          else{
            $('#news-table').html('<tr><td align="center" colspan="7">No records found.</td></tr>');
          }
        }
      });
    }

    function delete_news(id){
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>index.php/news/delete',
        dataType: 'json',
        data: {
          id : id
        },
        success: function(result){
          if(result.success){ 
            get();
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