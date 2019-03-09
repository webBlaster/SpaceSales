$(document).ready(checker);

function checker(){
   // auth = undefined;
    let state = $('#state');
    $.ajax({
        url:'../Inc/Authchecker.php',
        method:'post',
        dataType:'json',
        success:(response)=>{
            if(response == 1){
                console.log(response);
                state.html(`<a id="logout" href="../user/Logout.php">logout</a>`);
                console.log('logged in');
                window.auth = true;
                getfeeds();
            }else{
                getfeeds();
                console.log('not logged in');
                window.auth = false;
            }
        }
    });
}
//gets the feeds from db
let getfeeds = () =>{
    $.ajax({
        url:'../freeaccess/getfeeds.php',
        method:'get',
        dataType:'json',
        success:(response)=>{
            console.log(response);
        }
    });
}
