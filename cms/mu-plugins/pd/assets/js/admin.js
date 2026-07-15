jQuery(function ( $ ) {
  var $customizePageSelect = $('.customize-publishing-actions select')

  $customizePageSelect.on('change', function ( e ) {
    var $this = $(this)

    $this.siblings('.preview.button')
         .attr('href', $this.val())
         .attr('target', 'wp-preview-' + $this.find(':selected').data('id'))
  })  
})

if ( typeof(gform) !== 'undefined' ) {
  gform.addFilter('gform_editor_field_settings', function ( settings, field ) {
    if ( field.type === 'date' ) {        
      return settings.filter(function ( setting ) {
        switch ( setting ) {
          case '.date_input_type_setting':
          case '.date_format_setting':
          case '.css_class_setting':
          case '.visibility_setting':
            return false
          default:
            return true
        }
      })
    }
      
    return settings
  })
}