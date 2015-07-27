(function($) {
    var $sourceField = $("#wchau_source" );

    if(!$sourceField.length) return;

    var $otherField = $("input[name='wchau_source']");

    function checkOtherField() {
        if($sourceField.val() == "other") {
            $otherField.prop('disabled', false);
            $otherField.show();
        } else {
            $otherField.prop('disabled', true);
            $otherField.hide();
        }
    }

    checkOtherField();

    $sourceField.on('change', checkOtherField);
})(jQuery);