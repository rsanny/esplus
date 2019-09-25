function modalOkno(){
        var ayax = "";
        $('#modals').css('display', 'block').animate({ opacity: 1 });
        MyModal('#modals','#mw_overlay');
        console.log(ayax);
        $.ajax({
            url:'/local/include/ajax/popText.php?id=2',
            data: { id:ayax },
            type: 'GET',
            beforeSend: function() {
                $('#loader').show();
             },
             complete: function(){
                $('#loader').hide();
             },
            success: function(res){
                modals('modals',res);
                //aniOpacity(".modal-img","#mw_close");
            },
            error: function(){
                //alert('Error!');
            }
        });
}

function modals(id,results){
    $("#"+id).html(results);
 }
 
/*
var timerId = setTimeout(function() {
    modalOkno();
  }, 2000);

setTimeout(function() {

    closeID('#mw_close','#modals','#mw_overlay');
    servise_show('#foot-data-re');
  }, 6000);
*/

 function aniOpacity(id1,id2){
     $(id1).fadeIn(900,
      function () {
          $(this).animate({ height: "show" }, 1000);
      });
      $(id2).fadeIn(900,
          function () {
              $(this).animate({ height: "show" }, 1000);
          });
  }

 function servise_show(id1){
     $(id1).fadeIn(900,
      function () {
          $(this).animate({ height: "show" }, 1000);
      });
  }

 function MyModal(DataIdMOd,overlay) {
     $(DataIdMOd).fadeIn(400,
         function () {
             $(DataIdMOd).css('display', 'block').animate({ opacity: 1 });
         });
     $(overlay).fadeIn(400,
         function () {
             $(DataIdMOd).css('display', 'block').animate({ opacity: 1 });
         });

     }

function closeID(DataId,DataIdMOd,overlay){
    $(DataId).css('display', 'none');
    $(overlay).fadeOut(400);
    $(DataIdMOd).empty();
    $("#foot-data-re").fadeIn(400);

}

function footDataRe(){
    $("#foot-data-re").css('display', 'none');
    modalOkno();
}

setInterval(function(){ 
    var id = $('#xyz_text input').attr('id');
    var name = $('#xyz_text input').attr('name');
    //console.log(id);
    //console.log(name);
    $.ajax({
        url:'/local/include/ajax/data-arefmetika-capchy-ajax.php',
        data: { name:name,id:id },
        type: 'GET',
        beforeSend: function() {
            $('#loader').show();
         },
         complete: function(){
            $('#loader').hide();
         },
        success: function(res){
            modals('xyz_text',res);
        },
        error: function(){
            //alert('Error!');
        }
    });
}, 10000);