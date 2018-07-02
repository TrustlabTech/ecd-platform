$( document ).ready(function() {
    $(".select2").select2();

    $('.date-pick-me').combodate({
        minYear: 1975,
        maxYear: 2020,
        minuteStep: 10,
        format: 'YYYY-MM-DD',
        template: 'D / MMM / YYYY',
        customClass: "form-control"
    });
});

$( document ).ready(function() {
    $(".select2-centreId").select2({width: ''});

    $('#centre_id').on('change', function() {
        var centreId = this.value;

        if ($(".select2-classId").hasClass("select2-hidden-accessible")) {
            $(".select2-classId").select2("destroy");
        }

        $('.select2-classId').empty();
        $('#children_list_wrapper').empty();

        $.getJSON('/attendance/retrieve/classes/' + centreId, function(data){
            var option = new Option('Please Select', '', true, true);
            $('.select2-classId').append(option);

            $(data).each(function(key, value) {
                var option = new Option(value.name, value.id);
                $('.select2-classId').append(option);
            });

            $('.select2-classId').select2({width: ''});
            $('.hide-row').show();
        });
    });

    $('#class_id').on('change', function() {
        var classId = this.value;

        $('#children_list_wrapper').empty();

        $.ajax({
            type: 'GET',
            url: '/attendance/retrieve/children/' + classId,
            dataType: 'html',
            success: function(data) {
                $('#children_list_wrapper').append(data);
            }
        });
    });
});
