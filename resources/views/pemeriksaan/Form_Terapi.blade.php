<section>

  <label class="col-md-3 col-sm-3  control-label">Pilih Obat
        <br>
        <small class="text-navy">Kode Obat| Nama Obat</small>
    </label>
    <div class="item form-group">
        <select class="form-control" name="Obat_Id" id="Obat_Id" placeholder="Select Obat..." style="width: 50%">

          </select>
    </div>

    <label class="col-md-3 col-sm-3  control-label">Dosis Obat
        <br>
    </label>
    <div class="item form-group">
        <input class="form-control" name="Dosis" id="Dosis">
    </div>

    <label class="col-md-3 col-sm-3  control-label">Jumlah Obat
        <br>
    </label>
    <div class="item form-group">
        <input type="number" class="form-control" name="Jumlah_Obat" id="Jumlah_Obat">
    </div>

    <div class="form-group">
        <button type="button" id="add" class="btn btn-primary">
            Tambah <span class="glyphicon glyphicon-plus" style="color:white" aria-hidden="true"></span>
        </button>
    </div> 
    {{-- <input type="hidden" id="url" name="url" value="{{asset('pemeriksaan/umum/createperiksa')}}"> --}}
            
    <div id="ObatDetails" class="table-responsive">
       
        <script type="text/javascript">

            function initializeRemotelyValidatingElementsWithAdditionalFields($form) {
                var remotelyValidatingElements = $form.find("[data-val-remote]");

                $.each(remotelyValidatingElements, function (i, element) {
                    var $element = $(element);

                    var additionalFields = $element.attr("data-val-remote-additionalfields");

                    if (additionalFields.length == 0) return;

                    var rawFieldNames = additionalFields.split(",");

                    var fieldNames = $.map(rawFieldNames, function (fieldName) { return fieldName.replace("*.", ""); });

                    $.each(fieldNames, function (i, fieldName) {
                        $form.find("#" + fieldName).change(function () {
                            // force re-validation to occur
                            $element.removeData("previousValue");
                            $element.valid();
                        });
                    });
                });
            }

            $(document).ready(function () {
                initializeRemotelyValidatingElementsWithAdditionalFields($("#myFormId"));
            });
        </script>

    <script type="text/javascript">
        function replaceAll(find, replace, str) {
            while (str.indexOf(find) > -1) {
                str = str.replace(find, replace);
            }
            return str;
        }

        function thousandFormat(n) {
            var rx = /(\d+)(\d{4})/;
            return String(n).replace(/^\d+/, function (w) {
                while (rx.test(w)) {
                    w = w.replace(rx, '$1.$2.$3');
                }
                return w;
            });
        }

        $(document).ready(function () {
            // var ObatDetails = [];
            // //Remove button click function
            // $('#remove').click(function () {
            //     ObatDetails.pop();

            //     //populate order items
            //     GeneratedItemsTable();
            // });

            // //Add button click function
            // $('#add').click(function () {

            //     //Check validation of order item
            //     var isValidItem = true;
            //     var pesan = $('#Obat_Id').val();
            //     if ($('#Obat_Id').val().trim() == '') {
            //         isValidItem = false;
            //         $('#Obat_Id_message').css('visibility', 'visible');
            //     }
            //     else {
            //         $('#Obat_Id_message').css('visibility', 'hidden');
            //     }

            //     if ($('#Dosis').val().trim() == '') {
            //         isValidItem = false;
            //         $('#Dosis').siblings('span.error').css('visibility', 'visible');
            //     }
            //     else {
            //         $('#Dosis').siblings('span.error').css('visibility', 'hidden');
            //     }

            //     if ($('#Jumlah_Obat').val().trim() == '') {
            //         isValidItem = false;
            //         $('#Jumlah_Obat').siblings('span.error').css('visibility', 'visible');
            //     }
            //     else {
            //         $('#Jumlah_Obat').siblings('span.error').css('visibility', 'hidden');
            //     }

            //     //Add item to list if valid
            //     if (isValidItem) {
            //         ObatDetails.push({
            //             Obat_Id: parseInt($('#Obat_Id').val().trim()),
            //             Nama_Obat: $("#Obat_Id option:selected").text(),
            //             Dosis: $('#Dosis').val().trim(),
            //             Jumlah_Obat: $('#Jumlah_Obat').val().trim(),
            //         });
            //         //Clear fields
            //         $('#Obat_Id').val('').focus();
            //         $('#Dosis').val('');
            //         $('#Jumlah_Obat').val('');

            //     }
            //     //populate order items
            //     GeneratedItemsTable();

            // });
            // //Save button click function
            

            // //function for show added items in table
            // function GeneratedItemsTable() {
            //     if (ObatDetails.length > 0) {
                 
            //         var $table = $('<table class="table table-striped table-bordered table-hover table-sm table-font-sm">');
            //         $table.append('<thead class="thead-default thead-green"><tr><th>Nama Obat</th><th>Dosis</th><th>Jumlah Obat</th><th align="center"><i class="glyphicon glyphicon-cog"></i></th></tr></thead>');
            //         var $tbody = $('<tbody/>');
            //         var $total = 0;
            //         $.each(ObatDetails, function (i, val) {
            //             var $row = $('<tr/>');
            //             $row.append($('<td/>').html(val.Nama_Obat));
            //             $row.append($('<td/>').attr('align', 'right').html(val.Dosis));
            //             $row.append($('<td/>').attr('align', 'right').html(val.Jumlah_Obat));
            //             var $remove = $('<a href="#" class="btn-sm btn-danger">Hapus <span class="glyphicon glyphicon-trash"></span></a>');
            //             $remove.click(function (e) {
            //                 e.preventDefault();
            //                 ObatDetails.splice(i, 1);
            //                 GeneratedItemsTable();
            //             });
            //             $row.append($('<td/>').attr('align', 'center').html($remove));
            //             $tbody.append($row);
            //             $total += val.Jumlah_Obat;
            //         });
            //         var $frow = $('<tr/>');
            //         // $frow.append($('<td/>').attr('align', 'right').html('<b>Total</b>'));
            //         // $frow.append($('<td/>').attr('align', 'right').html(thousandFormat($total)));
            //         // $frow.append($('<td/>').html(''));
            //         $tbody.append($frow);
            //         console.log("current", ObatDetails);
            //         $table.append($tbody);
            //         $('#ObatDetails').html($table);

            //     }
            //     else {
            //         $('#ObatDetails').html('');
            //     }
            // }
        });
    </script>
</section>