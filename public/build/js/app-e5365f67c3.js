$( document ).ready(function() {
    $( "#id_number" ).blur(function() {
        var idNumberValue = $( '#id_number' ).val();
        if (idNumberValue.trim() !== "") {
            if ( validate(idNumberValue) )
            {
                if ( $( "#id_number" ).parent().closest( 'div' ).hasClass('has-warning') )
                {
                    $( "#id_number" ).parent().closest( 'div' ).removeClass('has-warning');
                }

                if ( $( "#id_number" ).hasClass('form-control-warning') )
                {
                    $( "#id_number" ).removeClass('form-control-warning');
                }

                if ( $( "#idNotValid" ).length ) {
                    $( "#idNotValid" ).remove();
                }
            } else {
                if (! $( "#id_number" ).parent().closest( 'div' ).hasClass('has-warning') )
                {
                    $( "#id_number" ).parent().closest( 'div' ).addClass('has-warning');
                }

                if (! $( "#id_number" ).hasClass('form-control-warning') )
                {
                    $( "#id_number" ).addClass('form-control-warning');
                }

                if ( $( "#idNotValid" ).length === 0) {
                    $( "#id_number" ).parent().closest( 'div' ).append($('<label id="idNotValid" class="form-control-label" for="id_number">ID Number not valid</label>'))
                }
            }
        } else {
            if ( $( "#id_number" ).parent().closest( 'div' ).hasClass('has-warning') )
            {
                $( "#id_number" ).parent().closest( 'div' ).removeClass('has-warning');
            }

            if ( $( "#id_number" ).hasClass('form-control-warning') )
            {
                $( "#id_number" ).removeClass('form-control-warning');
            }

            if ( $( "#idNotValid" ).length ) {
                $( "#idNotValid" ).remove();
            }
        }
    });
    $( "#za_id_number" ).blur(function() {
        var idNumberValue = $( '#za_id_number' ).val();
        if (idNumberValue.trim() !== "") {
            if ( validate(idNumberValue) )
            {
                if ( $( "#za_id_number" ).parent().closest( 'div' ).hasClass('has-warning') )
                {
                    $( "#za_id_number" ).parent().closest( 'div' ).removeClass('has-warning');
                }

                if ( $( "#za_id_number" ).hasClass('form-control-warning') )
                {
                    $( "#za_id_number" ).removeClass('form-control-warning');
                }

                if ( $( "#idNotValid" ).length ) {
                    $( "#idNotValid" ).remove();
                }
            } else {
                if (! $( "#za_id_number" ).parent().closest( 'div' ).hasClass('has-warning') )
                {
                    $( "#za_id_number" ).parent().closest( 'div' ).addClass('has-warning');
                }

                if (! $( "#za_id_number" ).hasClass('form-control-warning') )
                {
                    $( "#za_id_number" ).addClass('form-control-warning');
                }

                if ( $( "#idNotValid" ).length === 0) {
                    $( "#za_id_number" ).parent().closest( 'div' ).append($('<label id="idNotValid" class="form-control-label" for="id_number">ZA ID Number not valid</label>'))
                }
            }
        } else {
            if ( $( "#za_id_number" ).parent().closest( 'div' ).hasClass('has-warning') )
            {
                $( "#za_id_number" ).parent().closest( 'div' ).removeClass('has-warning');
            }

            if ( $( "#za_id_number" ).hasClass('form-control-warning') )
            {
                $( "#za_id_number" ).removeClass('form-control-warning');
            }

            if ( $( "#idNotValid" ).length ) {
                $( "#idNotValid" ).remove();
            }
        }
    });

    if ($('#id_number').length != 0) {
        if ($('#id_number').val().length != 0) {
            var idNumberValue = $( '#id_number' ).val();
            if (validate(idNumberValue) === false) {
                $( "#id_number" ).parent().closest( 'div' ).addClass('has-warning');
                $( "#id_number" ).addClass('form-control-warning');

                $( "#id_number" ).parent().closest( 'div' ).append($('<label id="idNotValid" class="form-control-label" for="id_number">ID Number not valid</label>'))
            }
        }
    }

    if ($('#za_id_number').length != 0) {
        if ($('#za_id_number').val().length != 0) {
            var idNumberValue = $( '#za_id_number' ).val();
            if (validate(idNumberValue) === false) {
                $( "#za_id_number" ).parent().closest( 'div' ).addClass('has-warning');
                $( "#za_id_number" ).addClass('form-control-warning');

                $( "#za_id_number" ).parent().closest( 'div' ).append($('<label id="idNotValid" class="form-control-label" for="za_id_number">ID Number not valid</label>'))
            }
        }
    }

    $('#button-tim').click(function(e){
        e.preventDefault();
        var hiddenForm = $('<form>', {
            'action': $('#tim_id_url').val(),
            'method': 'POST',
            'target': '_top'
        }).hide().append($('<input>', {
            'name': 'id_number',
            'value': $('#id_number').val(),
            'type': 'hidden'
        })).append($('<input>', {
            'name': '_token',
            'value': $('input:hidden[name=_token]').val(),
            'type': 'hidden'
        })).appendTo("body").submit();
    });
});

$( document ).ready(function() {
    $('.date-pick-me').combodate({
        minYear: 1975,
        maxYear: 2017,
        minuteStep: 10,
        format: 'YYYY-MM-DD',
        template: 'D / MMM / YYYY',
        customClass: "form-control"
    });

    $(".select2").select2();
});
