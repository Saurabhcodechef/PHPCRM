var base_path = 'http://localhost:81/project1/index.php/usermaster/';
$(document).ready(function () {
    $('#user_Form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_path + "add_user",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.error) {
                    if (data.name_error != '') {
                        $('#name_error').html(data.name_error);
                        setTimeout(function () {
                            $('#name_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#name_error').html('');
                    }
                    if (data.email_error != '') {
                        $('#email_error').html(data.email_error);
                        setTimeout(function () {
                            $('#email_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#email_error').html('');
                    }
                    if (data.phone_error != '') {
                        $('#phone_error').html(data.phone_error);
                        setTimeout(function () {
                            $('#phone_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#phone_error').html('');
                    }
                    if (data.pass_error != '') {
                        $('#pass_error').html(data.pass_error);
                        setTimeout(function () {
                            $('#pass_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#pass_error').html('');
                    }
                }
                if (data.success) {
                    $('#success_message').html(data.success);
                    $('#name_error').html('');
                    $('#email_error').html('');
                    $('#phone_error').html('');
                    $('#address_error').html('');
                    $('#user_Form')[0].reset();
                    $('#tbody').html(data.html);
                    setTimeout(function () {
                        $('#success_message').html("");
                    }, 3000);
                }
            }
        });
    });

    $('#name').keyup(function () {
        let str1 = $(this).val();
        let len = $(this).val().length;
        let flag;

        for (let i = 0; i < len; i++) {
            let s1 = new RegExp('[a-z|A-Z\\s]', 'g');
            flag = 0;
            if (!s1.exec(str1[i])) {
                flag = 1;
                break;
            }
        }
        if (flag == 1) {
            $('#name_error').html('');
            $('#name_error').html("<p>* Name is Invalid</p>");
        }
        else {
            $('#name_error').html('');
        }

    });
    // $('#email').keyup(function () {
    //     let str1 = $('#email').val();
    //     if (isEmpty(str1)) {
    //         $('#email_error').html('');
    //         $('#email_error').html("<p>* Email-Id is Required</p>");
    //     }
    //});
    $('#phone').keyup(function () {

        let str1 = $('#phone').val();
        let len = $('#phone').val().length;
        let flag;
        if (len == 10) {
            $('#phone_error').html('');
            $('#phone_error').html('<p class="text-success">Phone NO is Correct</p>');
        }
        if (len > 10) {
            $('#phone_error').html('');
            $('#phone_error').html("<p>* Phone No is Invalid</p>");
        }
        else if (isEmpty(str1)) {
            $('#phone_error').html('');
            $('#phone_error').html("<p>* Phone No is Required</p>");
        }
        else {
            for (let i = 0; i < len; i++) {
                let s1 = new RegExp('[0-9]', 'g');
                flag = 0;
                if (!s1.exec(str1[i])) {
                    flag = 1;
                    break;
                }
            }
            if (flag == 1) {
                $('#phone_error').html('');
                $('#phone_error').html("<p>* Phone no is Invalid</p>");
            }
            else {
                $('#phone_error').html('');
            }
        }
    });

    $('#popup').click(function () {
        $('#popup').attr('display', 'none');
    });

    $('#showpass').click(function () {
        if ($('#showpass').prop('checked'))
            $('#pass').attr('type', 'text');
        else
            $('#pass').attr('type', 'password');
    });

});

function getUser(id) {
    let Id = $('#' + id).attr('data-id');

    $.post(
        base_path + 'get_User', {
        userId: Id
    }, (data, status) => {
        let userData = JSON.parse(data);
        $('#name').val(userData['userName']);
        $('#name').attr('data-id', Id);
        $('#email').val(userData['email']);
        $('#phone').val(userData['phone']);
        $('#pass').val(userData['pass']);
        $('#update').show();
        $('#submit').hide();
    });
}

function updateUser() {
    if ($('#userForm').find('.error').length == 0) {
        let id = $('#name').attr('data-id');
        let name = $('#name').val();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let pass = $('#pass').val();
        let data = { 'userId': id, 'userName': name, 'email': email, 'phone': phone, 'password': pass };
        data = JSON.stringify(data);
        $.post(base_path + 'update_User',
            {
                userData: data
            }, (html) => {
                $('#tbody').html(html);
                $('#update').hide();
                $('#submit').show();
                $('form').trigger("reset");
            });
    }

}


function deleteUser(id, state = 0) {
    let Id = $('#' + id).attr('data-id');
    var result = confirm(Id + " Are Want to delete ?");
    if (result) {
        $.post(
            base_path + 'delete_User', {
            userId: Id
        }, (data, status) => {
            console.log(data);
            let userData = JSON.parse(data);
            if (state == 1) {
                return
            }
            if (userData['msg'] != undefined) {
                let msg = '<div id="popup"class="alert col-md-5 offset-md-2 alert-danger">Currently <strong>Active User</strong> Not Allowed to delete</div>';
                $('.msg').prepend(msg);
            }
            let html = '';
            users = userData['users'];
            for (let i = 0; i < users.length; i++) {
                html += "<tr id='row-'" + (i + 1) + ">\
                    <td class='text-center'>"+ (i + 1) + "</td>\
                    <td class='text-center'>"+ users[i]['userName'] + "</td>\
                    <td class='text-center'>"+ users[i]['email'] + "</td>\
                    <td class='text-center'>"+ users[i]['phone'] + "</td>\
                    <td class='text-center'>"+ users[i]['created_Date'] + "</td>\
                    <td class='text-center'>"+ users[i]['created_By'] + "</td>\
                    <td width='200px'>\
                        <a id='upd-"+ (i + 1) + "' data-id='" + users[i]['USERID'] + "'class='btn btn-primary'onclick='updateUser(this.id)'  aria-expanded='false'>Edit</a>\
                        <a id='del-"+ (i + 1) + "' data-id='" + users[i]['USERID'] + "'class='btn btn-danger' onclick='deleteUser(this.id)'>Delete</a>\
                    </td>\
                    </tr>";
            }
            $('#tbody').html(html);


        });
    }
}
function isEmpty(str) {
    return (!str || str.length === 0);
}
