var base_path = 'http://localhost:81/project1/index.php/clientmaster/';
$(document).ready(function () {
    $('#client_Form').on('submit', function (event) {

        event.preventDefault();
        $.ajax({
            url: base_path + "add_Client",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.error) {
                    if (data.name_error != '') {
                        $('#name_error').html(data.name_error);
                        setTimeout(() => {
                            $('#name_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#name_error').html('');
                    }
                    if (data.email_error != '') {
                        $('#email_error').html(data.email_error);
                        setTimeout(() => {
                            $('#email_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#email_error').html('');
                    }
                    if (data.phone_error != '') {
                        $('#phone_error').html(data.phone_error);
                        setTimeout(() => {
                            $('#phone_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#phone_error').html('');
                    }
                    if (data.address_error != '') {
                        $('#address_error').html(data.address_error);
                        setTimeout(() => {
                            $('#address_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#address_error').html('');
                    }
                }
                if (data.success) {
                    $('#success_message').html(data.success);
                    $('#name_error').html('');
                    $('#email_error').html('');
                    $('#phone_error').html('');
                    $('#address_error').html('');
                    $('#client_Form')[0].reset();
                    $('#tbody').html(data.html);
                    setTimeout(() => {
                        $('#success_message').html("");
                    }, 3000);
                }
            }
        });
    });

    $('#addClient').click(function () {
        $('#clientForm').toggle();
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
            $('#nameError').remove();
            $('#name').after("<span id='nameError'style='color:red;'>* Name is Invalid</span>")
        }
        else {
            $('#nameError').remove();
        }
    });
    $('#phone').keyup(function () {

        let str1 = $('#phone').val();
        let len = $('#phone').val().length;
        let flag;
        if (len > 10) {
            $('#phoneError').remove();
            $('#phone').after("<span id='phoneError'style='color:red;'>* Phone is Invalid</span>");
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
                $('#phoneError').remove();
                $('#phone').after("<span id='phoneError'style='color:red;'>* Phone No is Invalid</span>");
            }
            else {
                $('#phoneError').remove();
            }
        }
    });



});



function deleteClient(id, state = 0) {
    let Id = $('#' + id).attr('data-id');
    var result = confirm(Id + " Are Want to delete ?");
    if (result) {
        $.post(
            base_path + 'delete_Client', {
            clientId: Id
        }, (data, status) => {

            let clientData = JSON.parse(data);
            if (state == 1) {
                return
            }
            let html = '';
            for (let i = 0; i < clientData.length; i++) {
                html += "<tr id='row-'" + (i + 1) + ">\
                <td class='text-center'>"+ (i + 1) + "</td>\
                <td class='text-center'>"+ clientData[i]['clientName'] + "</td>\
                <td class='text-center'>"+ clientData[i]['email'] + "</td>\
                <td class='text-center'>"+ clientData[i]['phone'] + "</td>\
                <td class='text-center'>"+ clientData[i]['address'] + "</td>\
                <td class='text-center'>"+ clientData[i]['created_Date'] + "</td>\
                <td class='text-center'>"+ clientData[i]['created_By'] + "</td>\
                <td width='200px'>\
                    <a id='upd-"+ (i + 1) + "' data-id='" + clientData[i]['ClientID'] + "'class='btn btn-primary'onclick='updateClient(this.id)'  aria-expanded='false'>Edit</a>\
                    <a id='del-"+ (i + 1) + "' data-id='" + clientData[i]['ClientID'] + "'class='btn btn-danger' onclick='deleteClient(this.id)'>Delete</a>\
                </td>\
                </tr>";
            }
            $('#tbody').html(html);

        });
    }

}

function getClient(id) {
    let Id = $('#' + id).attr('data-id');

    $.post(
        base_path + 'get_Client', {
        clientId: Id
    }, (data, status) => {
        let clientData = JSON.parse(data);
        $('#name').val(clientData['clientName']);
        $('#name').attr('data-id', Id);
        $('#email').val(clientData['email']);
        $('#phone').val(clientData['phone']);
        $('#address').val(clientData['address']);
        $('#submit').hide();
        $('#update').show();

    });
}

function updateClient() {
    debugger;
    let name = $('#name').val();
    let id = $('#name').attr('data-id');
    let email = $('#email').val();
    let phone = $('#phone').val();
    let add = $('#address').val();
    let data = { 'clientName': name, 'clientId': id, 'email': email, 'phone': phone, 'address': add };
    data = JSON.stringify(data);
    $.post(
        base_path + 'update_client', {
        clientData: data
    }, (html) => {
        $('#tbody').html(html);
        $('#submit').show();
        $('#update').hide();
        $('form').trigger("reset");

    });

}

