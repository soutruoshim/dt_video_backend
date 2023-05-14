<?php $this->load->view('admin/comman/header');?>
<!-- UserList Data Show -->
<div class="clearfix"></div>
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">Comment</h4>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Comment</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumb-->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="default-datatable" class="table table-bordered dataTables_font">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th> Book Name </th>
                    <th> Comment </th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  
                 // p($comments);
                  $i=1; foreach($comments as $row){ ?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td style="width: 10%">
                        <?php  echo string_cut($row->title,30); ?>
                      </td>
                      <td style="width: 30%">
                        <?php  echo string_cut($row->comment,50); ?>
                      </td>
                      <td><?php echo  dateformate($row->created_at); ?></td>
                      <td>
                        <div class="active_<?php echo $row->id; ?>">
                          <?php if($row->status == '1'){?>
                          <a style="color: #ffffff;"  href="#" onclick="update_status('<?php echo $row->id; ?>','<?php echo $row->status; ?>')"> <i class="fa fa-toggle-on blockquote-footer fa-2x"></i></a> 
                          <?php }else{?>
                          <a style="color: #ffffff;"  href="#" onclick="update_status('<?php echo $row->id; ?>','<?php echo $row->status; ?>')"> <i class="fa fa-toggle-off blockquote-footer fa-2x"></i></a> 

                          <?php }?>
                        </div>
                      </td>
                    </tr>
                    <?php $i++;} ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php  $this->load->view('admin/comman/footerpage');?>
      <script type="text/javascript">
        function update_status(id,status)
        {
          $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>admin/comments/update',
                data:{'id':id,'status':status},
                success:function(resp){
                  var obj = JSON.parse(resp);
                  var text = '';
                  if(obj.book_status == '1'){
                    
                    text =' <a style="color: #ffffff;"  href="#" onclick="update_status('+id+',`'+obj.book_status+'`)"> <i class="fa fa-toggle-on blockquote-footer fa-2x"></i></a>';
                  }else{
                    text ='<a style="color: #ffffff;"  href="#" onclick="update_status('+id+',`'+obj.book_status+'`)"> <i class="fa fa-toggle-off blockquote-footer fa-2x"></i></a>';
                  }
                  $('.active_'+id).html(text);
                }
              });
        }
        $(document).ready(function(){
          $('#default-datatable').DataTable();
        });
      </script>