<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="{{ url('storage/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('storage/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('storage/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ url('storage/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('storage/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('storage/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('storage/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('storage/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('storage/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('storage/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('storage/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('storage/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('storage/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('storage/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('storage/dist/js/adminlte.min.js') }}"></script>
<!-- Kit -->
<script src="https://kit.fontawesome.com/0028badcae.js" crossorigin="anonymous"></script>
<!-- DataTables  & Plugins -->
<script src="{{ url('storage/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('storage/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('storage/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('storage/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('storage/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ url('storage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('storage/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ url('storage/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>



<script>
    $(function() {

        var table = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [{
                extend: 'print',
                customize: function(win) {
                    // Add your custom header content here
                    var header = $(win.document.body).find('h1').text("");
                    header.css('text-align', 'center');

                    var bankInfos = @json(session('bank_infos'));
                    var logoSrc = "/storage/images/banks/" + bankInfos[0].logo;
                    var bankName = bankInfos[0].name;
                    var bankAddress = bankInfos[0].address;
                    var bankEmail = bankInfos[0].email;
                    var bankContact = bankInfos[0]
                        .contact; // Add this line to get contact information

                    // Add the image with appropriate styling
                    var img = $('<img src="' + logoSrc +
                        '" style="height:90px;width:90px;margin-right:10px;vertical-align:middle;" />'
                    );
                    header.prepend(img).append(bankName);

                    // Create a div for email and contact
                    var infoDiv = $('<div style="text-align:center;"></div>');

                    infoDiv.append('<p style="font-size: 18px;">Email: ' + bankEmail +
                        '</p>'); // Adjust font size here
                    infoDiv.append('<p style="font-size: 18px;">Contact: ' + bankContact +
                        '</p>'); // Adjust font size here
                    infoDiv.append('<p style="font-size: 18px;">Address: ' + bankAddress +
                        '</p>'); // Adjust font size here

                    // Append the infoDiv to the header
                    header.append(infoDiv);


                }
            }]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)').css('margin-bottom', '10px');

        // Add CSS rule to move only the input box to the right
        $('#example1_wrapper .dataTables_filter').css('text-align', 'right');
        $('#example2_wrapper .dataTables_filter').css('text-align', 'right');

        // Customize the printed document
        // table.buttons('print', null).container().appendTo($('#example1_wrapper .col-md-6:eq(0)'));

        // table.on('customize', function(doc) {
        //     // Add your logo to the header
        //     doc.content.splice(0, 0, {
        //         text: {{ url('storage/images/blood-reserve.jpg') }}, // Replace with the URL or HTML for your logo
        //         margin: [0, 0, 0, 12], // Adjust margins as needed
        //         alignment: 'center'
        //     });
        // });

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": false
        });

        $('#example3').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": false,
            "length": 10
        });
    });
</script>



<script>
    $(function() {
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', function(event) {
            event.preventDefault();
            document.body.classList.toggle('sidebar-collapse');
        });
    });
</script>
<script>
    $(function() {
        //Date picker
        $('#datepicker_add').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        })
        $('#datepicker_edit').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        })

        // //Timepicker
        // $('.timepicker').timepicker({
        // showInputs: false
        // })

        // //Date range picker
        // $('#reservation').daterangepicker()
        // //Date range picker with time picker
        // $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
            }
        )

    });
</script>
