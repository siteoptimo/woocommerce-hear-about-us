(function($) {
    var $sourceField = $("#wchau_source" );

    if(!$sourceField.length) return;

    var $otherField = $("input[name='wchau_source']");
    var $otherFieldContainer = $otherField.closest('.form-row');

    function checkOtherField() {
        if($sourceField.val() == "other") {
            $otherField.prop('disabled', false);
            $otherFieldContainer.show();
        } else {
            $otherField.prop('disabled', true);
            $otherFieldContainer.hide();
        }
    }

    checkOtherField();

    $sourceField.on('change', checkOtherField);
})(jQuery);