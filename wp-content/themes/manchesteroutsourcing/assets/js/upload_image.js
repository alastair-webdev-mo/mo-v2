jQuery(function($){

  // Set all variables to be used in scope
  var frame,
      addImgLink = $('.upload_card_image'),
      imgURLInput = $('.image1');
      imgAlt = $('.image1_alt');

  addImgLink.on( 'click', function( event ){

    event.preventDefault();

    if ( frame ) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select or Upload Image',
      button: {
        text: 'Use this Image'
      },
      multiple: false 
    });

    frame.on( 'select', function() {

      var attachment = frame.state().get('selection').first().toJSON();

      // Send the attachment URL to our custom image input field.
      //imgContainer.append( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );

      imgURLInput.val( attachment.url );
      imgAlt.val( attachment.alt );
    });

    frame.open();
  });

});