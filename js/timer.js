function show(){
    $.ajax({
        url: "php/commonList.php",
        cache: false,
        success: function(data){
            $("#commonList").html(data);
        }
    });
};

function date(){
    var field = document.querySelector('#reg');
    var date = new Date();

    field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) +
    '-' + date.getDate().toString().padStart(2, 0);
}

$(document).ready(function(){
    show();
    setInterval('show()', 100000);
    date();
    /*setInterval('date', 100);*/
});

