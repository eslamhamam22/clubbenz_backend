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
                            <h4 class="page-title">Listing cars</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <a style="background: #2CABE3" href="<?php echo base_url('cars/add_cars') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Car</a>
                            <a style="background: #2CABE3" href="<?php echo base_url('cars/import_cars') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Import Cars</a>

                        </div>
                    </div>
                    <?php $this->load->view('message');?>
                    <div style="overflow-x: auto">
                        <table id="myTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Class/Model</th>
                                <th>Start/End</th>
                                <th>Chassis</th>
                                <th>Vin Prefix</th>

                                <th>Fuel Type</th>
                                <th>option</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
foreach ($rec as $us) {

	$fuel_name = $this->car->get_fuel_type($us->fuel_type);
	$year = $this->car->get_modell($us->model_id);

	$chassis_number = $this->car->get_chassis_number($us->chassis);

	?>
                                <tr>
                                    <td><?php echo $year->name . "<br>" . $us->model; ?></td>
                                    <td><?php echo $us->model_year_start . "<br>" . $us->model_year_end; ?></td>
                                    <td><?php if (isset($chassis_number)) {echo $chassis_number->chassis_num;}?></td>
                                    <td><?php echo $us->vin_prefix; ?></td>
                                    <td><?php echo $fuel_name->name; ?></td>
                                    <td>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('cars/edit_car') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('cars/car_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>

                    </div>
                    <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
        </div>
        <?php $this->load->view('common/common_script');?>
         <script>
            $(document).ready( function () {
                $('#myTable thead tr').clone(true).appendTo( '#myTable thead' );
                $('#myTable thead tr:eq(1) th').each( function (i) {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

                    $( 'input', this ).on( 'keyup change', function () {
                        if ( table.column(i).search() !== this.value ) {
                            table
                                .column(i)
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );



                var table = $('#myTable').DataTable( {
                    orderCellsTop: true,
                    fixedHeader: true
                } );





            } );
        </script>
    </body>
</html>
