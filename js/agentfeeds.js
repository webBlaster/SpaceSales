
$(document).ready(function(){
    $.ajax({
        url:'../agent/Authchecker.php',
        method:'post',
        dataType:'json',
        success:(response)=>{
            if(response==1){
                console.log("working");
            }
            else{
                window.location.href="../index.html";
            }
        }
    });
//load previously added products
$.ajax({
    url:'../agent/Myspaces.php',
    method:'post',
    dataType:'json',
    success:(response)=>{
        if(response==0){
            console.log("nothing changes nigga");
            $('#loader').css('display','block');
        }else{
            console.log(response);
            $('#loader').html("");
            $.each(response,(index,value)=>{
                console.log(value.agent,value.description);
                let template = 
                `<div class="card">
                <img src="${value.image}" class="img-responsive"/>
                <div id="${value.id}" class="strings">
                <h2>${value.price} Naira</h2>
                <h3>${value.location}</h3>
                <b>${value.description}</b><br/>
                <button class="edit btn btn-primary">Edit</button>
                <button class="remove btn btn-primary">Remove</button>
                </div>
                </div>`;
                $("#loader").append(template);
            });
            //add event listeners to the template buttons

            //edits the product
            $('.edit').click((e)=>{
                let productid = e.target.parentElement.getAttribute('id');
                let data = {id:productid};
                $.ajax({
                    url:'../freeaccess/feedinfo.php',
                    data:data,
                    method:'post',
                    dataType:'json',
                    success:(response)=>{
                        let template = `<div id="back" class="btn">back</div>
                        <div id="fileuploader">
                        <form id="fileuploader-form" data-id="${response[0].id}" enctype="multipart/form-data" >
                            <input id="location" class="form-control" type="text" value="${response[0].location}" placeholder="Location" name="location"><br>
                            <input id="price" class="form-control" type="text" value="${response[0].price}" placeholder="Price" name="price"><br>
                            <textarea id="info" class="form-control"  placeholder="information" name="info">${response[0].description}</textarea><br>
                            <input id="image" type="file" name="file" value="${response[0].image}" class="form-control adjust"><br>
                            <input id="submit" class="btn btn-primary adjust form-control" type="submit" name="submit" value="submit">
                        </form>
                        </div>`;
                        $('#loader').hide();
                        $('#addnew').hide();
                        $('#settings').html(template);
                        //function to validate the input then submit to the back end 
                        validatethensubmit('../agent/Editor.php',data.id);
                        //event listener to the back button
                        $('#back').click((e)=>{
                            e.preventDefault();
                            window.location.href="agents.html";
                        });
                    }
                });
            });
            //removes the products
            $('.remove').click((e)=>{
                let productid = e.target.parentElement.getAttribute('id');
                let template =`<div id="makesure">
                    <h4>are you sure you want to remove this product</h4>
                    <input id="${productid}" class="btn btn-primary" type="button" value="YES">
                    <input id="no" class="btn btn-primary" type="button" value="NO">
                </div>`;
                $('body').html("");
                $('body').append(template);
                $('#'+productid).click((e)=>{
                        e.preventDefault();
                        let data = {id:productid};
                        $.ajax({
                            url:'../agent/Remove.php',
                            data:data,
                            method:'post',
                            dataType:'json',
                            success:(response)=>{
                                if(response==1){
                                    window.location.href="agents.html"; 
                                }
                                
                            }
                        });
                    }
                );
                $('#no').click(
                   function (e){
                       e.preventDefault;
                       window.location.href="agents.html";
                   }
                );
            });
        }
    }
})
//loads the interface to add new product
    $('#addnew').click(function(){
        $('#loader').hide();
        $('#addnew').hide();
        let template = `<div id="back" class="btn">back</div>
        <div id="fileuploader">
        <form id="fileuploader-form" enctype="multipart/form-data" >
            <input id="location" class="form-control" type="text" placeholder="Location" name="location"><br>
            <input id="price" class="form-control" type="text" placeholder="Price" name="price"><br>
            <textarea id="info" class="form-control"  placeholder="information" name="info"></textarea><br>
            <input id="image" type="file" name="file" class="form-control adjust"><br>
            <input id="submit" class="btn btn-primary adjust form-control" type="submit" name="submit" value="submit">
        </form>
        </div>`;
        $('#settings').html(template).hide();
        $('#settings').fadeIn(1000);
        //adds a click event listener to the loaded template button
         validatethensubmit('../agent/Uploader.php',null);  
         //event listener to the back button
         $('#back').click((e)=>{
             e.preventDefault();
             window.location.href="agents.html";
         });
    });
});

//function to validate the input then submit to the back end 
function validatethensubmit(url,id){
    $('#submit').click(function(e){
        e.preventDefault();
        const location = $('#location').val();
            const price = $('#price').val();
            const info = $('#info').val();
            const img = $('#image').val();
            
            //file type validation
            if((location && price && info && img) == ""){
                console.log('form is incomplete');
            }
            else if(location || price || info || img != ""){
                const image = document.querySelector("#image").files[0];
                const name = image.name;
                const imgextension = name.split('.').pop().toLowerCase();
                const imagesize = image.size;
                console.log("good to go");

                if($.inArray(imgextension,["gif",'png',"jpg",'jpeg']) == -1){
                    console.log("you can only upload image files")
                }else if(imagesize>3000000){
                    console.log("Image size limit is 3MB");
                }else{
                    let data = new FormData($("#fileuploader-form")[0]);
                    data.append('id',id);
                    $.ajax({
                        url:url,
                        method:'post',
                        data:data,
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:(response)=>{
                            console.log(response);
                            $("#fileuploader").fadeOut();
                            $('body').load('agents.html');
                        }
                    });
                }
            }
        })
}