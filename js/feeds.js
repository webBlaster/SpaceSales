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
function getfeeds(){
    $.ajax({
        url:'../freeaccess/getfeeds.php',
        method:'get',
        dataType:'json',
        success:(response)=>{
           console.log(response);
            $.each(response,(index,value)=>{
                //template for product block
                const template = `<li id="${value.id}" class = "feed-block">
                <div class="image-cell">
                <img src="${value.image}" class="img-responsive">
                </div>
                <div class="info">
                <h2>${value.price} Naira</h2>
                <h3>${value.location}</h3>
                </div>
                <input type="submit" value="view" class="btn btn-primary green">
                </li>`;
                $('#feeds').append(template);
            });
            //event listener for the product block view button
            $('.green').click((e)=>{
                let elem = e.target.parentElement.getAttribute("id");
                console.log('its ready o',elem);
                let data = {id:elem};
                $.ajax({
                    url:'../freeaccess/feedinfo.php',
                    method:'post',
                    dataType:'json',
                    data:data,
                    success:(response)=>{
                        console.log(response);
                        //template for product page
                        let template = `<div id="view" data-id="${response[0].id}">
                            <img src="${response[0].image}" class="img-responsive">
                            <h3>${response[0].location}</h3>
                            <h2>${response[0].description}<h2>
                            <button id="owner" class="btn btn-primary">contact Owner</button>
                            <button id="back" class="btn btn-primary">back</button>
                        </div>`;
                        $('.container').html(template);
                        //add event listeners to back button and contact owner
                        $('#back').click(()=>{
                            $('body').load('spacefeeds.html');
                        });
                        $('#owner').click(()=>{
                            if(auth == false){
                                window.location.href = "../index.html";
                            }
                            console.log('guy chill out am thinking of a template to send you to');
                        });
                    }
                });
            });
        }
    });
}
