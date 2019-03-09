const siSubmit = $('#si-submit');

const suSubmit = $('#su-submit');

//Form Validator Functions
const siChecking = (e) => {
    //Signin form Reference
    var notify = $('#notify');
    const siEmail = document.querySelector('#si-email').value;
    const siPassword = document.querySelector('#si-password').value;
    e.preventDefault();
    if(siEmail && siPassword !== ""){
        let data = $('#si-form').serialize();
        console.log("talking to back end.......");
        $.ajax({
            url:'user/Login.php',
            method:'post',
            dataType:'json',
            data:data,
            success:(response) => {
                if(response == 0){
                    console.log(response);
                    notify.html('wrong info');
                }
                else{
                    console.log(response);
                    window.location.href = response;
                }
            }
        })
    }else{
        console.log("fill in empty parts");
        notify.html('fill in empty parts');
    }
}

const suChecking = (e) => {
    //Signup form Reference
    var info = $('#info');
    const suEmail = document.querySelector('#su-email').value;
    const suPassword = document.querySelector('#su-password').value;
    const suPassword2 = document.querySelector('#su-password2').value;
    e.preventDefault();
    if(suPassword !== suPassword2){
        console.log('Check your Password');
        info.html('<p>Check your Password</p>');
    }

    else if(suEmail && suPassword !== ""){
        let data = $('#su-form').serialize();
        $.ajax({
            url:"user/RegisterUser.php",
            method:"POST",
            dataType:'JSON',
            data:data,
            success:(response) => {
                if(response == 0){
                    console.log('username already exists');
                    info.html('<p>Username aleady exists</p>');
                }
                else{
                    console.log('registration successful');
                    window.location.href =response;
                }
                
            }
        });
    }
    else{
        console.log("fill in empty parts");
        info.html('<p>fill in empty parts</p>');
    }
    
}

//Add event Listeners
siSubmit.on("click",siChecking);
suSubmit.on("click",suChecking);


