<script type="text/javascript">
    
    $("a[href='" + window.location.href + "']").parent().addClass('active');

    let locale = $('html').attr('lang');

    $('#dataTable').DataTable({
        "language": {
            "url": locale == 'ar' ? "https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json" : "https://cdn.datatables.net/plug-ins/1.11.3/i18n/en.json"
        },
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible:not(:last-child)',
                    font: 'Arial, Helvetica, sans-serif',
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }        

        ]
    });
    
    var elements = CKEDITOR.document.find( '.editor' ),
        i = 0,
        element;

    while (( element = elements.getItem( i++ ) )) {
        CKEDITOR.replace( element );
    }

    function check_all_perm(model){
        $('input[class=' + model + ']:checkbox').each(function(){
            if($('input[class="checkall_'+model+'"]:checkbox:checked').length == 0){
            $(this).prop('checked', false);
            }else{
            $(this).prop('checked', true);
            }
        });
    }
    function deleteItem(attr){
   
        Swal.fire({
            title: "{{ __('admin.do_you_want_to_delete')}}",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: "{{ __('admin.delete')}}",
            cancelButtonText: "{{ __('admin.no')}}",
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    icon: 'success',
                    title: "{{ __('admin.deleted_successfully')}}",
                    showConfirmButton: false,
                    // confirmButtonText: 'تم',
                    // customClass: {
                    //     confirmButton: 'btn btn-success'
                    // }
                });
                $(attr).submit();
            }else{
                                
                Swal.fire({
                    icon: 'success',
                    title: "{{ __('admin.canceled')}}",
                    showConfirmButton: false,
                    timer:1000
                });
            }
        });
    }

    function dragNdrop(event) {
        var fileName = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview");
        var previewImg = document.createElement("img");
        previewImg.setAttribute("src", fileName);
        preview.innerHTML = "";
        preview.appendChild(previewImg);
    }
    function drag() {
        document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
    }
    function drop() {
        document.getElementById('uploadFile').parentNode.className = 'dragBox';
    }

        
    function discocunt_type(val){
        if(val == "amount"){
            $("#amount").show();
            $('#discount_amount').prop('name', 'discount_amount');
            $("#percentage").hide();
            $('#discount_percentage').prop('required',false);
        }
        if(val == "percentage"){
        
            $("#percentage").show();
            $('#discount_percentage').prop('name', 'discount_percentage');
            $("#amount").hide();
            $('#discount_amount').prop('required',false);
        }
        if(val == ""){
            $("#amount").hide();
            $('#discount_amount').prop('required',false);
            $("#percentage").hide();
            $('#discount_percentage').prop('required',false);
        }
    }

        
    function question_type(val){
        if(val == "category"){
            $("#category").show();
            $('#category_questionable_id').prop('disabled', false);
            $("#service").hide();
            $('#service_questionable_id').prop('disabled', true);
        }
        if(val == "service"){
        
            $("#service").show();
            $('#service_questionable_id').prop('disabled', false);
            $("#category").hide();
            $('#category_questionable_id').prop('disabled', true);
        }
        if(val == ""){
            $("#category").hide();
            $("#service").hide();
        }
    }

        
    function show_discount_price_input(checkbox){
        const discountPriceDiv = document.getElementById('discount_price_div');
        const discountPriceInput = document.getElementById('discount_price');

        if (checkbox.checked) {
            discountPriceDiv.style.display = 'block';
            discountPriceInput.required = true;

        } else {
            discountPriceDiv.style.display = 'none';
            discountPriceInput.required = false;

        }
    }

    //$("a[href='" + window.location.href + "']").closest('.expanded').addClass('is-expanded');

</script>

@yield('js')
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs" ></script>
