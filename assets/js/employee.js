(function( $ ){
    $('#employee_file').on('change',function(e){
        $(this).next('.custom-file-label').html(e.target.files[0].name);
        $('#employee_avatar').val('');
    });

})( jQuery );
