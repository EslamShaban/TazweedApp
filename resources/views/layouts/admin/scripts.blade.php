<script type="text/javascript">
    
    $("a[href='" + window.location.href + "']").parent().addClass('active');

    let locale = $('html').attr('lang');

    $('#dataTable').DataTable({
        "language": {
            "url": locale == 'ar' ? "https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json" : "https://cdn.datatables.net/plug-ins/1.11.3/i18n/en.json"
        }
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

    //$("a[href='" + window.location.href + "']").closest('.expanded').addClass('is-expanded');

</script>

@yield('js')
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs" ></script>
