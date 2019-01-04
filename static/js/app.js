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
        $('#' + modal).addClass('modal-show')
        $('.modal-card').addClass('modal-bouncein')
        $('body').append('<div class="modal-background"></div>')
    })
    $('body').on('click', '.modal-background', function () {
        closefunction()
    })
    $('body').on('click', '.cancel', function () {
        closefunction()
    })



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
        var item = $('.check-action:checked');
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
    $('.closealert').click(function(){
        closealert()
    })

    function filterTable() {
      // Declare variables 
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }

    $('#search').keyup(function() {
        filterTable();
    })
});
function showalert(){
    $('body').append('<div class="overlay"></div>');
    $('.alert').addClass('modal-show')
    $('.modal-card').addClass('modal-bouncein')
}
function closealert(){
    $('.modal-card').removeClass('modal-bouncein')
    $('.modal-card').addClass('modal-bounceout')
    setTimeout(function () {
        $('.modal').removeClass('modal-show')
        $('.overlay').remove()
        $('.actions').hide();
        $('.action').show();
        $('body').find('table input[type="checkbox"]').prop('checked', false);
        // M.toast({
        //     html: '<i class="material-icons left">error</i><span>Data delete successful.</span>',
        //     classes: 'teal',
        //     displayLength: 1000,
        //     completeCallback: function(){

        //     }
        // })
    },350);

}

function closefunction() {
    $('.modal-card').removeClass('modal-bouncein')
    $('.modal-card').addClass('modal-bounceout')
    $('.actions').hide()
    $('.action').show()
    $('body').find('table input[type="checkbox"]').prop('checked', false);

    setTimeout(function () {
        $('.modal').removeClass('modal-show')
        $('.modal-background').remove();
    },100);
}