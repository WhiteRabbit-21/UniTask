var faculty = 0;
    function fun1(){
        var sel = document.getElementById('selectFaculty').selectedIndex;
        var options = document.getElementById('selectFaculty').options;
        faculty= options[sel].text;
    }; 
dormin = 0;
function fun2(){
        var sel = document.getElementById('selectDorm').selectedIndex;
        var options = document.getElementById('selectDorm').options;
        dormin = options[].text;
    };

$(document).ready(function() {
    //кнопка меню "Головна"
    $('.mBtnMain').on('click', function(){
        document.getElementById('result').style.display='block';
        document.getElementById('commonList').style.display='block';
        document.getElementById('infoBar').style.display='block';
        document.getElementById('newStudent').style.display='none';
    });

    // кнопка меню "Керування"
    $('.mBtnCtrl').on('click', function(){
        document.getElementById('result').style.display='none';
        document.getElementById('commonList').style.display='none';
        document.getElementById('infoBar').style.display='none';
        document.getElementById('newStudent').style.display='block';
    });

    //кнопка меню "Вихід"
    $('.mBtnExit').on('click', function(){
        window.location.href = 'php/logout.php';
    })

    // кнопка поиска студента на главной странице
    $('button.find').on('click', function() {
        var arraySplit = 0;
        function splitName(nameToSplit, separator){
            arraySplit = nameToSplit.split(separator);
        };

        var nameValue = $('input.name').val();
        var space = ' ';

        splitName(nameValue, space);
        var aName = arraySplit[1];
        var aLastName = arraySplit[0];
        $.ajax({
            type: "POST",
            url: "php/find.php",
            data: {name: aName, lastName: aLastName},
            success:function(data) {
                $("#result").html(data);
            }
        });
        $('input.name').val('');
        $('input.lastName').val('');
    });

    // кнопка добавления студента в БД
    
    $('button.create').on('click', function(){
        var nameValue = $('input.nameStud').val();
        var lastNameValue = $('input.lastName').val();
        var secondNameValue = $('input.secondName').val();
        var genderValue = 0;
        var birthValue = document.getElementById("birth").value;
        var facultyValue = faculty;
        var groupeValue = $('input.groupe').val();
        var phoneValue = $('input.phone').val();
        var parentsPhoneValue = $('input.parentsPhone').val();
        var roomValue = $('input.room').val();
	var dateOfreg = document.getElementById("reg").value;
	var dorminVal = dormin;
	

        function checkValue (){
            var chkbxMan;
            var chkbxWoman;

            chkbxMan = document.getElementById('man');
            chkbxWoman = document.getElementById('woman');

            if(chkbxMan.checked){
                genderValue = 'Чоловіча';
            } else {
                if(chkbxWoman.checked){
                    genderValue = 'Жіноча';
                	} else {
                    genderValue = 'N/A';
                }
            }
        };
        
        checkValue();
       
        $.ajax({
            type: "POST",
            url: "php/addStudents.php",
            data: {name: nameValue, lastName: lastNameValue, secondName: secondNameValue, gender: genderValue, birth: birthValue, faculty: facultyValue, groupe: groupeValue, phone: phoneValue, parentsPhone: parentsPhoneValue, room: roomValue, reg: dateOfreg, dormin:dorminVal }
        })
        .done(function(msg){
            alert("Студент зареєстрований!");
        });

        $('input.nameStud').val('');
        $('input.lastName').val('');
        $('input.secondName').val('');
        $('input:checked').prop('checked', false);
	$('input:reg').val('');
        $('input.birth').val('');
        $('input.phone').val('');
        $('input.parentsPhone').val('');
        $('input.groupe').val('')
        $('input.room').val('');
    });

    
});
