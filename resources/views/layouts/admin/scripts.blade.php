<script type="text/javascript">
    
    $("a[href='" + window.location.href + "']").parent().addClass('active');

    
    $('#dataTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/ar.json"
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
            title: 'هل تريد الحذف ؟',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'حذف',
            cancelButtonText: 'لا',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'تم الحذف بنجاح',
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
                    title: 'تم الإلغاء',
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

    //$("a[href='" + window.location.href + "']").closest('.expanded').addClass('is-expanded');

</script>

@yield('js')
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs" ></script>
