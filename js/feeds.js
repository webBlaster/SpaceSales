$(document).ready(checker);

//function for checking if the user is authenticated
function checker() {
  // auth = undefined;
  let state = $("#state");
  $.ajax({
    url: "../Inc/Authchecker.php",
    method: "post",
    dataType: "json",
    success: (response) => {
      if (response == 1) {
        console.log(response);
        state.html(`<a id="logout" href="../user/Logout.php">logout</a>`);
        $("#history").show();
        console.log("logged in");
        window.auth = true;
        getfeeds();

        //event listener for the user history button
        $("#history").click(() => {
          $.ajax({
            url: "../user/LoadHistory.php",
            type: "post",
            dataType: "json",
            success: (response) => {
              if (response == 0) {
                console.log("you have no transaction");
                let template = `<h2 id="nohistory">You Have No Transaction History</h2>`;
                $("#history").html('<a href="">Back</a>');
                $("#main").html(template);
              } else {
                $("#history").html('<a href="">Back</a>');
                $("#main").html("");
                $("#main").css("margin-top", "40px");
                let history = response;
                $.each(history, (key) => {
                  console.log(history);
                  let temp = `<div class="user-history">
                    <h4>${history[key].user}</h4>
                    <h4>${history[key].title}</h4>
                    <p>@:${history[key].time}</p>
                  </div>`;
                  $("#main").append(temp);
                });
              }
            }
          });
        });
      } else {
        $("#history").hide();
        getfeeds();
        console.log("not logged in");
        window.auth = false;
      }
    }
  });
}
//gets the feeds from db
function getfeeds() {
  $.ajax({
    url: "../freeaccess/getfeeds.php",
    method: "get",
    dataType: "json",
    success: (response) => {
      console.log(response);
      if (response == 0) {
        console.log(response);
      } else {
        $.each(response, (index, value) => {
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
          $("#feeds").append(template);
        });
      }

      //event listener for the product block view button
      $(".green").click((e) => {
        let elem = e.target.parentElement.getAttribute("id");
        console.log("its ready o", elem);
        let data = { id: elem };
        $.ajax({
          url: "../freeaccess/feedinfo.php",
          method: "post",
          dataType: "json",
          data: data,
          success: (response) => {
            console.log(response);
            //template for product page
            let template = `<div id="view" data-id="${response[0].id}">
                            <img src="${
                              response[0].image
                            }" class="img-responsive" style="width:50%; margin: 60px auto;">
                            <h3>${response[0].location}</h3>
                            <h2>${response[0].description}<h2>
                            <button id="owner" class="btn btn-primary">contact Owner</button>
                            <button id="back" class="btn btn-primary">back</button>
                        </div>`;
            $(".container").html(template);
            //add event listeners to back button and contact owner
            $("#back").click(() => {
              $("body").load("spacefeeds.html");
            });
            $("#owner").click(() => {
              if (auth == false) {
                window.location.href = "../index.html";
              } else {
                let template = `
                            <div id="reachout" class="fluid-container">
                            <h2>Drop your name and mobile number</h2>
                            <input type="text" id="name" placeholder="Name" class="form-control"><br/>
                            <input type="text" id="number" placeholder="Phone Number" class="form-control"><br/>
                            <button id="submit" class="btn">Submit</button>
                            </div>
                            `;
                $("#main").html(template);
                $("#submit").click(() => {
                  const name = $("#name").val();
                  const number = $("#number").val();
                  const id = response[0].id;
                  if (name && number !== "") {
                    let data = {
                      id: id,
                      name: name,
                      number: number
                    };
                    $.ajax({
                      url: "../user/notifyagent.php",
                      method: "post",
                      dataType: "json",
                      data: data,
                      success: (response) => {
                        if (response == 1) {
                          let template = `<div id = "getback">
                          <h1>The Agent Is Currently Being Notified</h1>
                          <p>You Will Be Contacted In Less Than 12Hours</p>
                          <button class="btn"><a href="spacefeeds.html">Home</a></button>
                        </div>`;
                          $("#main").html("");
                          $("#main").html(template);
                        } else {
                          console.log("cat");
                        }
                      }
                    });
                  } else {
                    console.log("fill in all parts");
                  }
                });
              }
            });
          }
        });
      });
    }
  });
}
