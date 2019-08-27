
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');  //get Id from button
            var modal = $(this);
            var url="{{url('users')}}/"+id;
            console.log(url);
            $('#fid').attr('action',url); //get Id form
        });

        $('#deleteNGO').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');  //get Id from button
            var modal = $(this);
            var url="{{url('ngo')}}/"+id;
            console.log(url);
            $('#fid').attr('action',url); //get Id form
        });

        $('#deleteCandidate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');  //get Id from button
            var modal = $(this);
            var url="{{url('candidates')}}/"+id;
            console.log(url);
            $('#fid').attr('action',url); //get Id form
        });

        // ==========show modal of user=============
        $('#ViewDetail').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id')
            var fname = button.data('fname')
            var lname = button.data('lname')
            var role_id = button.data('role')
            var email = button.data('email')
            var role;
            // console.log('id ' + id);
            // console.log('role id ' + role_id);
            if ( role_id == 1 ) {
                role = "Admin";
            }
            if ( role_id == 2 ) {
                role = "Nomal"
            }
            var modal = $(this)
            modal.find('#lname').text(lname);
            modal.find('#fname').text(fname);
            modal.find('#email').text(email);
            modal.find('#role').text(role);
        });
    </script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    <script>

    // ========== datatable ===============
        $(document).ready(function() {

            $('#tbl_users').DataTable( {
                colReorder: true
            });

            $('#ngo').DataTable( {
                colReorder: true
            });

            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();

        } );


        // =====================table ngo========================
        // Append table with add row form on add new button click
        $(".add-new").click(function(){
            $(this).attr("disabled", "disabled");
            var index = $("table tbody tr:last-child").index();
            var row = '<tr>' +
                '<td></td>' +
                '<td><input type="text" class="form-control" name="name" placeholder="Name NGO"/></td>' +
                '</tr>';
            $("table").append(row);
        });

    </script>

    </body>
</html>

