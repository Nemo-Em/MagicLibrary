$(function(){

  $.getJSON('http://localhost/library/api/src/api.php', function(data){
    for (var book of data){
      $("#bookIdChange").append("<option value="+ book['id'] +">"+ book['id'] +"</option>")
      $('#books').append("<a href ='#'class='displayBtn'>"+ book['title'] +"</a>");
      $("a").css("display","block");
      $('#books').append("<div class='bookDescr'>"
                          + "<span>author: " + book['author'] + "</span>"
                          + "<p>" + book['description'] + "</p>"
                          + "<button class='delete' id="+book['id']+">delete me!</button>"
                          +"</div>");
    }
    $(".bookDescr").css("display","none");
    $(".displayBtn").click(function(e){
      var descr = $(this).next()
      if(descr.css("display")=="none"){
        descr.css("display","block")
      }
      else if(descr.css("display")=="block"){
        descr.css("display","none")
      }
    });
    var deleteBtns = document.querySelectorAll("button")
    for(var i=0; i < deleteBtns.length; i++){
      var btn = deleteBtns[i];
      $(btn).click(function(c){
        c.preventDefault();

        $.ajax({
          type:"DELETE", data: {"id":this.id}, url:"http://localhost/library/api/src/api.php"
        })
        .done(function(){
          alert("book deleted");
          history.go(0);
         })
        .fail(function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
         })
      });
    }
  });
  $("#bookID-btn").click(function(a){
    a.preventDefault();
    var bookID = $("#bookID").val()
    $.get('http://localhost/library/api/src/api.php', {"id":bookID}, function(b){
      if (b['id'] == undefined){
        $("#bookTitleAuthor").text("no such book exists")
      }
      else{
        $("#bookTitleAuthor").text(b['title']+" by "+b['author'])
        $("#bookDescription").html(b['description'] + "<br><a href=''>back to all books</a>")
      }
    });
  });
  $("#newBook-btn").click(function(c){
    c.preventDefault();
    var bookTitle = $("#bookTitleInput").val()
    var bookAuthor = $("#bookAuthorInput").val()
    var bookDescr = $("#bookDescrInput").val()
    $.ajax({
      method: "POST",
      url: 'http://localhost/library/api/src/api.php',
      data: {title:bookTitle, author:bookAuthor, descr:bookDescr}
    })
    .done(function(){
      alert("book added");
      history.go(0);
     })
    .fail(function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
     })
  });
  $("#changeBook-btn").click(function(c){
    c.preventDefault();
    var bookID = $("#bookIdChange").val()
    var bookTitle = $("#bookTitleChange").val()
    var bookAuthor = $("#bookAuthorChange").val()
    var bookDescr = $("#bookDescrChange").val()
    $.ajax({
      type:"PUT", data: {"id":bookID, "title":bookTitle, "author":bookAuthor, "descr":bookDescr}, url:"http://localhost/library/api/src/api.php"
    })
    .done(function(){
      alert("book changed");
      history.go(0);
     })
    .fail(function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
     })
  });


});
