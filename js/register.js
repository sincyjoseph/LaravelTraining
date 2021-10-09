$(document).ready(function(){
    getdata();
});

$(".reset").click(function() {
    $('input[name="HI"]').val(0);
    $('input[name="username"]').val('');
    $('input[name="password"]').val('');
    $('input[name="email"]').val('');
    $('textarea[name="address"]').val('');
    $("#save_button").html('Save').data('action', 'save');
});

//get data
function getdata(){
        $.ajax({
            type: "GET",
            url: "ajax/crud.php",
            dataType: "json",
            success: function (response) {
                if(response.statusCode==200){
                // console.log(response);
                $.each(response.getData, function (key, value) { 
                    $('#table_data').append(
                        '<tr>'+
                        '<td>'+value['id']+'</td>'+
                        '<td>'+value['username']+'</td>'+
                        '<td>'+value['password']+'</td>'+
                        '<td>'+value['email']+'</td>'+
                        '<td>'+value['gender']+'</td>'+
                        '<td>'+value['address']+'</td>'+
                        '<td>'+value['declaration']+'</td>'+
                        '<td>'+value['created_at']+'</td>'+
                        '<td>'+value['status']+'</td>'+
                        '<td>'+
                            '<span class="btn btn-info edit" data-id="'+value['id']+'">Edit</span>'+
                            '&nbsp;'+
                            '<span class="btn btn-danger delete" data-id="'+value['id']+'">Delete</span>'+
                        '</td>'+
                        '</tr>'
                        );
                });
                }else if(result.statusCode==201) {
                    console.log(result);
                }
                onDelete();
                onEdit();
            }
        });
}

//delete operation
function onDelete() {
    $('.delete').off('click');
    $('.delete').on( 'click', function(){
        alert(123);
        var obj = $(this);
        var deleteId = $(this).data('id');
        var operation = 'delete';
        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
        $.ajax({
            url: 'ajax/crud.php',
            type: 'POST',
            data: { 
                deleteId: deleteId,
                operation: operation
            },
            dataType: "json",
            success: function(result){
                if (result.statusCode==200){
                    $(obj).closest('tr').remove();
                    console.log(result);
                } else if(result.statusCode==201) {
                    console.log(result);
                }
            }
        });
        }
    });
}
onDelete();

//edit operation
function onEdit() {
    $('.edit').off('click');
    $(".edit").on('click', function (e) {
        var row = $(this).closest('tr');
        var id = $(this).data("id");
        $("#save_button").html('Update').data('action', 'update');
        $(row).each(function () {
                var username = $(this).find("td:eq(1)").text().trim();
                var password = $(this).find("td:eq(2)").text().trim();
                var email = $(this).find("td:eq(3)").text().trim();
                var gender = $(this).find("td:eq(4)").text();
                if(gender == 'female'){
                    $('#female').prop( "checked", true );
                }else if(gender == 'male'){
                    $('#male').prop( "checked", true );
                }
                var address = $(this).find("td:eq(5)").text().trim();
                var declaration = $(this).find("td:eq(6)").text();
                if(declaration == 'checked'){
                    $('input[name="declaration"]').prop( "checked", true );
                }
                $('input[name="username"]').val(username);
                $('input[name="password"]').val(password);
                $('input[name="email"]').val(email);
                $('textarea[name="address"]').val(address);
                $('input[name="HI"]').val(id);
        });
    });
}
onEdit();

//save and update
$("#reg").submit(function(e) {
    var username = $('input[name="username"]').val();
    var password = $('input[name="password"]').val();
    var confirmpass = $('input[name="confirmpass"]').val();
    var email = $('input[name="email"]').val();
    var gender = $('input[name="gender"]:checked').val();
    var address = $('textarea[name="address"]').val();
    var declaration = $('input[name="declaration"]:checked').val();
    var operation = $("#save_button").data('action');
    var data = {
        username: username,
        password: password,
        email: email,
        gender: gender,
        address: address,
        declaration: declaration,
        operation:operation,
    };
    var gen = document.forms['myForm']['gender'];
    if(operation=='update'){
        var HI = $('input[name="HI"]').val();
        data.editId = HI;
    }
    $(".error").remove();
    if (username.length == 0) {
        $('#username').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(password.length == 0){
        $('#password').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(password != confirmpass){
        $('#confirmpass').after('<span class="error">Please confirm password</span>');
        e.preventDefault();
    }else if(email.length == 0){
        $('#email').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(gen[0].checked==false && gen[1].checked==false){
        $('#female').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(address.length == 0){
        $('#address').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else if(!document.getElementById('declaration').checked){
        $('#declaration').after('<span class="error">This field is required</span>');
        e.preventDefault();
    }else{
        $.ajax({
            url: 'ajax/crud.php',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function(result){
              if (result.statusCode==200){
                  console.log(result);
                  var rowCount = $("#table_data tr").length;
                  var status = 1;
                  if(operation == 'update'){
                      var tableRow = $("td").filter(function() {
                          return $(this).text() == HI;
                      }).closest("tr");    
                      //console.log(tableRow);
                      tableRow.find("td:eq(1)").html(username);
                      tableRow.find("td:eq(2)").html(password);
                      tableRow.find("td:eq(3)").html(email);
                      tableRow.find("td:eq(4)").html(gender);
                      tableRow.find("td:eq(5)").html(address);
                      tableRow.find("td:eq(6)").html(declaration);
                      tableRow.find("td:eq(7)").html(new Date().getFullYear()+"-"+new Date().getMonth()+"-"+new Date().getDate()+" "+
                                                     new Date().getHours()+":"+new Date().getMinutes()+":"+new Date().getSeconds());
                      $('#reg')[0].reset();
                      $('input[name="HI"]').val(0);
  
                  }else if (operation == 'save'){
                      var out = '<tr>';
                      out += '<td>'+ result.dataId+'</td>';
                      out += '<td>'+ data.username+'</td>';
                      out += '<td>'+ data.password+'</td>';
                      out += '<td>'+ data.email+'</td>';
                      out += '<td>'+ data.gender+'</td>';
                      out += '<td>'+ data.address+'</td>';
                      out += '<td>'+ data.declaration+'</td>';
                      out += '<td>'+ new Date().getFullYear()+"-"+new Date().getMonth()+"-"+new Date().getDate()+" "+
                                        new Date().getHours()+":"+new Date().getMinutes()+":"+new Date().getSeconds() + '</td>';
                      out += '<td>'+ status +'</td>';
                      out += '<td >';
                      out += '<span class="btn btn-info edit" data-id="'+ result.dataId +'">Edit</span>';
                      out += '&nbsp;';
                      out += '<span class="btn btn-danger delete" data-id="'+ result.dataId +'">Delete</span>';
                      out += '</td></tr>';
                      
                      if(rowCount > 0) {
                          $(out).insertAfter('#table_data tr:last');
                          $('#reg')[0].reset();
                      } else {
                          $('#table_data').html(output);
                          $('#reg')[0].reset();
                      }
                  }
                  onDelete();
                  onEdit();
              } else if (result.statusCode==201){
                  console.log(result);
              }else{
                  console.log("error");
              }
            }
          });
    }

});