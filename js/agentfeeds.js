
$(document).ready(function(){
//loads the interface to add new product
    $('#addnew').click(function(){
        $('#loader').hide();
        $('#addnew').hide();
        $('#settings').html(`<div id="fileuploader">
        <form id="fileuploader-form" enctype="multipart/form-data" >
            <input id="location" class="form-control" type="text" placeholder="Location" name="location"><br>
            <input id="price" class="form-control" type="text" placeholder="Price" name="price"><br>
            <textarea id="info" class="form-control"  placeholder="information" name="info"></textarea><br>
            <input id="image" type="file" name="file" class="form-control adjust"><br>
            <input id="submit" class="btn btn-primary adjust form-control" type="submit" name="submit" value="submit">
        </form>
        </div>`).hide();
        $('#settings').fadeIn(1000);
        $('#submit').click(function(e){
            e.preventDefault();
            const image = $('#image');
            let data = new FormData();
            data.append('section', 'general');
            data.append('action', 'previewImg');
            data.append('image', $('input[type=file]')[0].files[0]);
            //data.set('file', image);
            console.log(data);
        })     
    });
});
