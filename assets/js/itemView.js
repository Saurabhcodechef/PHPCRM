var base_path = 'http://localhost:81/project1/index.php/itemmaster/';
$(document).ready(function () {

    $('#item_Form').on('submit', function (e) {
        e.preventDefault();
        debugger;
        var formdata = new FormData($('#item_Form')[0]);
        //console.log(formdata.get('itemImg'));
        $.ajax({
            url: base_path + 'add_Item',
            type: 'POST',
            data: formdata,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (data) {
                data = JSON.parse(data);
                if (data.error) {
                    if (data.name_error != '') {
                        $('#name_error').html(data.name_error);
                        setInterval(() => {
                            $('#name_error').html("");
                        }, 3000);
                    }
                    else {
                        $('#name_error').html('');
                    }
                    if (data.price_error != '') {
                        $('#price_error').html(data.price_error);

                    }
                    else {
                        $('#price_error').html('');
                    }
                    if (data.upload_error != '') {
                        $('#upload_error').html(data.upload_error);

                    }
                    else {
                        $('#upload_error').html('');
                    }
                    setTimeout(function () {
                        $('#name_error').html('');
                        $('#price_error').html('');
                        $('#upload_error').html('');
                    }, 3000);
                }
                if (data.success != '') {
                    $('#success_message').html(data.success);
                    $('#name_error').html('');
                    $('#price_error').html('');
                    $('#upload_error').html('');
                    $('#item_Form')[0].reset();
                    $('#tbody').html(data.html);
                    setTimeout(function () {
                        $('#success_message').html('');
                    }, 3000);
                }
            }
        });

    });
    $('#updForm').on('submit', function (e) {
        e.preventDefault();
        let formdata = new FormData($(this)[0]);
        $.ajax({
            url: base_path + 'update_Item',
            type: 'POST',
            data: formdata,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (data) {
                console.log(data);
                data = JSON.parse(data);

                if (data.error) {
                    if (data.name_error != '') {
                        $('#updname_error').html(data.name_error);
                        setTimeout(function () {
                            $('#updname_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#updname_error').html('');
                    }
                    if (data.price_error != '') {
                        $('#updprice_error').html(data.price_error);
                        setTimeout(function () {
                            $('#updprice_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#updprice_error').html('');
                    }
                    if (data.upload_error != '') {
                        $('#updupload_error').html(data.upload_error);
                        setTimeout(function () {
                            $('#updupload_error').html('');
                        }, 3000);
                    }
                    else {
                        $('#updupload_error').html('');
                    }
                    setTimeout(function () {
                        $('#updname_error').html('');
                        $('#updprice_error').html('');
                        $('#updupload_error').html('');
                    }, 3000);
                }
                if (data.success) {
                    $('#success_message').html(data.success);
                    $('#updname_error').html('');
                    $('#updprice_error').html('');
                    $('#updupload_error').html('');

                    $('#tbody').html(data.html);
                    $('.modal').modal('hide');
                    setTimeout(function () {
                        $('#success_message').html('');
                    }, 3000);

                }
            }

        });
    });

    $('#price').keyup(function () {

        let str1 = $('#price').val();
        let len = $('#price').val().length;
        let flag;

        if (isEmpty(str1)) {
            $('#price_error').html('');
            $('#price_error').html("<p>#price No is Required</p>");
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
                $('#price_error').html('');
                $('#price_error').html("<p>#price no is Invalid</p>");
            }
            else {
                $('#price_error').html('');
            }
        }
    });
});

function deleteItem(id) {
    let Id = $('#' + id).attr('data-id');
    $.post(base_path + 'delete_Item',
        {
            itemId: Id
        }, (data, status) => {
            // let itemData = JSON.parse(data);
            // //alert(data);
            // let html = '';
            // for (let i = 0; i < itemData.length; i++) {

            //     html += '<tr id="row-' + (i + 1) + '">\
            //     <td class="text-center">'+ (i + 1) + '</td>\
            //     <td class="text-left">'+ itemData[i]['itemName'] + '</td>\
            //     <td class="text-left">'+ itemData[i]['price'] + '</td>\
            //     <td class="text-center"><img src="'+ itemData[i][`img`] + '"height="50px" width="50px"></td>\
            //     <td class="text-center"><iframe src="'+ itemData[i][`link`] + '"height="60px" width="60px"></iframe></td>\
            //         <td td class="text-center" > '+ itemData[i]["created_Date"] + '</td >\
            //     <td class="text-left">'+ itemData[i]['created_By'] + '</td>\
            //     <td class="text-center">\
            //         <a type="button" id="upd-'+ (i + 1) + '" data-id="' + itemData[i][`itemId`] + '" class="btn btn-primary" aria-expanded="false" onclick="getItem(this.id)">Update</a>\
            //         <a type="button" id="del-'+ (i + 1) + '" data-id="' + itemData[i][`itemId`] + '" class="btn btn-danger" onclick="deleteItem(this.id)">Delete</a>\
            //     </td>\
            // </tr > '
            // }
            $('#tbody').html(data);

        });
}

function getItem(id) {
    debugger;
    let Id = $('#' + id).attr('data-id');
    //alert(Id);
    $.post(base_path + 'get_Item', {
        itemId: Id
    }, (data, status) => {
        itemData = JSON.parse(data);
        $('#updName').val(itemData['itemName']);
        $('#updId').val(itemData['itemId']);
        $('#updPrice').val(itemData['price']);
        $('#updImg1').attr('data', itemData['img']);
        //$('#updlink').val(itemData['link']);
        $('#updlink').attr('src', itemData['link']);


        $('.modal').modal('show');

        //$('video').prop('autoplay', false);
    });

}

function isEmpty(str) {
    return (!str || str.length === 0);
}