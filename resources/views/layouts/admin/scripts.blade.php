<script type="text/javascript">

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
        swal({
            title: "{{ __('admin.sure')}}",
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('admin.yes')}}",
            cancelButtonText: "{{ __('admin.no')}}",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                swal("{{ __('admin.deleted')}}", "", "success");
            $(attr).submit();
            } else {
                swal("{{ __('admin.cancelled')}}", "", "error");
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
$("a[href='" + window.location.href + "']").addClass('active');
$("a[href='" + window.location.href + "']").closest('.expanded').addClass('is-expanded');
</script>

@yield('js')
