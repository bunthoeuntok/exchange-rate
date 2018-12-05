$(document).ready(function () {
// modal function
    $('.date').focus(function () {
        var eThis = $(this);
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;
        eThis.val(today);
    })
    $('.date').dateDropper();
    $('.show-modal').click(function () {
        var modal = $(this).attr('modal-data')
        $('#' + modal).css({
            // display: 'block'
        })
        $('.modal-card').css({
            animation: 'bounceIn .35s ease'
        });
        $('body').append('<div class="modal-background"></div>')
    })
    $('body').on('click', '.modal-background', function () {
        closefunction()
    })
    $('body').on('click', '.cancel', function () {
        closefunction()
    })

    function closefunction() {
        $('.modal-card').css({
            animation: 'bounceOut .35s ease'
        });
        $('.modal').delay(800).css({
            display: 'none'
        })
        $('.modal-background').remove()
    }

//material js
    $('.sidenav-hover').sidenav();
    $('.dropdown-trigger').dropdown({
        coverTrigger: false,
        constrainWidth: false,
        alignment: 'right',
        container: true
    });
    $('select').formSelect();
// checkbox onchange event for action
// checkbox onchange event for action
    $('body').on('change', '.table #check-action', function () {
        $('.check-action').prop("checked", $(this).prop("checked"));
        var item = $('.check-action:checked').map(function () {
            return $(this).val();
        }).get().join();
        items = item.length;
        if (items > 1) {
            $('.action').hide();
            $('.actions').show();
            $('#edit').addClass('disabled');
        }
        if (items == 0) {
            $('.action').show();
            $('.actions').hide();
        }

    })
    $('body').on('change', '.table .check-action', function () {
        $(this).prop("checked");
        var item = $("input:checkbox.check-action:checked");
        items = item.length;
        if (items > 0) {
            $('.action').hide();
            $('.actions').show();
        }
        if (items == 0) {
            $('.action').show();
            $('.actions').hide();
            $('#check-action').prop('checked', false);
        }
        if (items > 1) {
            $('#edit').addClass('disabled');
        } else {
            $('#edit').removeClass('disabled');
        }
    })
    $('.datepicker').datepicker({
        showClearBtn: true,
        yearRange: 30,
        format: 'yyyy-mm-dd'
    });
// $("body").click(function(e){
//     if(e.target.className !== "datepicker-modal" && e.target.className !== "input-field")
//     {
//       $(".datepicker-modal").hide();
//     }
// });
});