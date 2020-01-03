jQuery( '#file-test' ).change( function() {
  jQuery( '#file-test-name' ).show();
  jQuery( '#file-test-name' ).val( jQuery( this ).prop('files')[0].name);
  jQuery( this ).prop('files')[0].name);
});
