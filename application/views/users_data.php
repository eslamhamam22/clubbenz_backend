<?php $this->load->view('common/common_header');?>
    <body class="fix-header">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    
        <div id="wrapper" style="background: white">
            <?php $this->load->view('common/top_nav');?>
            <?php $this->load->view('common/left_nav');?>
                 <div id="page-wrapper"style="background: white">
                        <div class="container-fluid">
                            <div class="row bg-title">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <h4 class="page-title"></h4>
                                </div>
                                 <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('profile_image/add_pimage')?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Profile Image</a>
                                </div> -->
                            </div>
                    
                            <div class="col-md-4 col-lg-3" >
                                
                            </div>
                            <?php $this->load->view('message');?>
                          
                           <table id="myTable" class="table table-striped">
                    
                                <thead>
                                    <tr>
                                        <th> First Name</th>
                                        <th> Last Name</th>
                                        <th> Phone Name</th>
                                        <th> Email</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>    
                                    <?php
                                        foreach($rec as $r){
                                    ?>
                                    <tr>
                                        <td><?php echo $r['first_name'] ?></td>
                                        <td><?php echo $r['last_name'] ?></td>
                                        <td><?php echo $r['phone'] ?></td>
                                        <td><?php echo $r['email'] ?></td>
                                    </tr>       
                                    <?php } ?>
                                </tbody>
                            </table>    
                    <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
        </div>
         <?php $this->load->view('common/common_script');?>
         <script> 
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script> 
    </body>

</html>
