//var baseurl = window.location.origin;
var baseurl = "http://moallim.e-invoicesaudi.com/";
document.write('<script type="text/javascript" src="http://moallim.e-invoicesaudi.com/assets/libs/sweetalert2/sweetalert2.min.js"></script>');
window.retuen_data_ajax = null;


// Make Sure SW are supporated
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register(baseurl + '/assets/sw_cached_files.js')
        /* .then(reg => console.log('Service Worker: Registered'))
        .catch(err => console.log(`Service Worker: Error: ${err}`)) */
    })
}
// Submit form
$(document).on("click", ".ajaxform", function () {
    var tget = this;
    $(tget).prop('disabled', true);
    var omsgb = $(tget).attr('data-msg');
    var noteb = $(tget).attr('data-note');
    var aftreloadb = $(tget).attr('data-aftreload');
    var isformresetb = $(tget).attr('data-pvntreset');
    var noteg = (typeof noteb !== typeof undefined && noteb !== false) ? noteb : 'false';
    var omsg = (typeof omsgb !== typeof undefined && omsgb !== false) ? omsgb : 'outmsg';
    var aftreload = (typeof aftreloadb !== typeof undefined && aftreloadb !== false) ? aftreloadb : "false";
    var isformreset = (typeof isformresetb !== typeof undefined && isformresetb !== false) ? isformresetb : "false";
    var control = $(tget).attr('data-control');
    var formidg = $(tget).attr('data-form');
    var form_data = new FormData($('#' + formidg)[0]);
    // sweet alert variable
    var sweetAlertMsg = $(tget).attr('data-sweetalert');
    var sweetAlertCont = $(tget).attr('data-sweetalertcontrol');

    if(sweetAlertMsg){
        sweetAlertMsg = sweetAlertMsg.split('/');
        var titleMsgJs = sweetAlertMsg[0];
        var confMsgJs = sweetAlertMsg[1];
        var decMsgJs = sweetAlertMsg[2];
        var successMsgJs = sweetAlertMsg[3];
        var calMsgJs = sweetAlertMsg[4];
    }else{
        titleMsgJs = confMsgJs  = decMsgJs  = successMsgJs = calMsgJs = null;
    }

    confMsgJs = confMsgJs?confMsgJs:'Save';
    decMsgJs = decMsgJs?decMsgJs:`Don't save`;
    titleMsgJs = titleMsgJs?titleMsgJs:'Do you want to save the changes?';
    successMsgJs = successMsgJs?successMsgJs:'success';
    calMsgJs = calMsgJs?calMsgJs:'data not saved';
    // Swal.fire({
    //     title: "Payment Alert",
    //     text: "Amount not entered is greater than the outstanding amount",
    //     icon: "error",
    //     confirmButtonColor: "#556ee6"
    // });
    if(sweetAlertCont == 'Y'){
        Swal.fire({
            title: `${titleMsgJs}`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `${confMsgJs}`,
            denyButtonText: `${decMsgJs}`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            //   Swal.fire('Saved!', '', 'success')
                $.ajax({
                    type: 'post',
                    url: baseurl + "/" + control,
                    data: form_data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    
                        
                        beforeSend: function () {
                            $('#' + omsg).html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>').show();
                            $('.error').html('');
                            $("#status").fadeIn();
                            $("#preloader").fadeIn();
                        },
                        success: function (data) {
                            $(tget).prop('disabled', false);
                            var data = eval(data);
                            var outmsg = data.msg;
                            if (data.multi === "true") {
                                $('#' + omsg).html('');
                                $.each(outmsg, function (i, errmsg) {
                                    $(`#${i}-error`).html(errmsg);
                                });
                            } else {
                                var msgty = data.err === "false" ? "success" : "danger";
                                var pelmnt = $('#' + omsg).html("<div class='alert alert-" + msgty + "' role='alert'> " + outmsg + " </div>");
                                if (data.err === "false") {
                                    Swal.fire(`${successMsgJs}`, '', 'success');
                                    if (isformreset === "false") { $("#" + formidg)[0].reset(); }
                                    $('#datatable').DataTable().ajax.reload();
                                    if (aftreload === "true") { window.setTimeout(function(){location.reload()},1000); }
                                    if (noteg === "true") { $('#summernote').summernote("reset"); }
                                    pelmnt.show().delay(5000).fadeOut();
                                } else {
                                    pelmnt.show().delay(8000).fadeOut();
                                }
                            }
                            $("#status").fadeOut();
                            $("#preloader").fadeOut();
                        },
                        error: function (jqXHR, exception) {
                            $(tget).prop('disabled', false);
                            $('#' + omsg).html('');
                            if (jqXHR.status === 0) {
                                alert('Not connect.\n Verify Network.');
                            } else if (jqXHR.status == 404) {
                                alert('Requested page not found. [404]');
                            } else if (jqXHR.status == 500) {
                                alert('Internal Server Error [500].');
                            } else if (exception === 'parsererror') {
                                alert('Requested JSON parse failed.');
                            } else if (exception === 'timeout') {
                                alert('Time out error.');
                            } else if (exception === 'abort') {
                                alert('Ajax request aborted.');
                            } else {
                                alert('Uncaught Error.\n' + jqXHR.responseText);
                            }
                        }
                });
                return false;
            } else if (result.isDenied) {
                Swal.fire(`${calMsgJs}`, '', 'info')
                $(tget).prop('disabled',false);
            }
        })
    }else if(!sweetAlertCont){
        $.ajax({
            type: 'post',
            url: baseurl + "/" + control,
            data: form_data,
            dataType: 'json',
            processData: false,
            contentType: false,
            
                
                beforeSend: function () {
                    $('#' + omsg).html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>').show();
                    $('.error').html('');
                    $("#status").fadeIn();
                    $("#preloader").fadeIn();
                },
                success: function (data) {
                    $(tget).prop('disabled', false);
                    var data = eval(data);
                    var outmsg = data.msg;
                    if (data.multi === "true") {
                        $('#' + omsg).html('');
                        $.each(outmsg, function (i, errmsg) {
                            $(`#${i}-error`).html(errmsg);
                        });
                    } else {
                        var msgty = data.err === "false" ? "success" : "danger";
                        var pelmnt = $('#' + omsg).html("<div class='alert alert-" + msgty + "' role='alert'> " + outmsg + " </div>");
                        if (data.err === "false") {
                            if (isformreset === "false") { $("#" + formidg)[0].reset(); }
                            $('#datatable').DataTable().ajax.reload();
                            if (aftreload === "true") { location.reload(); }
                            if (noteg === "true") { $('#summernote').summernote("reset"); }
                            pelmnt.show().delay(5000).fadeOut();
                        } else {
                            pelmnt.show().delay(8000).fadeOut();
                        }
                    }
                    $("#status").fadeOut();
                    $("#preloader").fadeOut();
                },
                error: function (jqXHR, exception) {
                    $(tget).prop('disabled', false);
                    $('#' + omsg).html('');
                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
        });
        return false;
    }

    // if (confirm('Are you sure? Your data sent to the server could not be rolled back after you submitted this form.')) {

        // $.ajax({
        //     type: 'post',
        //     url: baseurl + "/" + control,
        //     data: form_data,
        //     dataType: 'json',
        //     processData: false,
        //     contentType: false,
            
                
        //         beforeSend: function () {
        //             $('#' + omsg).html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>').show();
        //             $('.error').html('');
        //         },
        //         success: function (data) {
        //             $(tget).prop('disabled', false);
        //             var data = eval(data);
        //             var outmsg = data.msg;
        //             if (data.multi === "true") {
        //                 $('#' + omsg).html('');
        //                 $.each(outmsg, function (i, errmsg) {
        //                     $(`#${i}-error`).html(errmsg);
        //                 });
        //             } else {
        //                 var msgty = data.err === "false" ? "success" : "danger";
        //                 var pelmnt = $('#' + omsg).html("<div class='alert alert-" + msgty + "' role='alert'> " + outmsg + " </div>");
        //                 if (data.err === "false") {
        //                     if (isformreset === "false") { $("#" + formidg)[0].reset(); }
        //                     $('#datatable').DataTable().ajax.reload();
        //                     if (aftreload === "true") { location.reload(); }
        //                     if (noteg === "true") { $('#summernote').summernote("reset"); }
        //                     pelmnt.show().delay(5000).fadeOut();
        //                 } else {
        //                     pelmnt.show().delay(8000).fadeOut();
        //                 }
        //             }
        //         },
        //         error: function (jqXHR, exception) {
        //             $(tget).prop('disabled', false);
        //             $('#' + omsg).html('');
        //             if (jqXHR.status === 0) {
        //                 alert('Not connect.\n Verify Network.');
        //             } else if (jqXHR.status == 404) {
        //                 alert('Requested page not found. [404]');
        //             } else if (jqXHR.status == 500) {
        //                 alert('Internal Server Error [500].');
        //             } else if (exception === 'parsererror') {
        //                 alert('Requested JSON parse failed.');
        //             } else if (exception === 'timeout') {
        //                 alert('Time out error.');
        //             } else if (exception === 'abort') {
        //                 alert('Ajax request aborted.');
        //             } else {
        //                 alert('Uncaught Error.\n' + jqXHR.responseText);
        //             }
        //         }
        // });
        // return false;
    // }else{
    //     $(tget).prop('disabled', "");
    // }
});

/*================================ Modal FORM Submit ==============================*/

$(document).on("click", ".form-modal", function () {
    var tget = this;
    $(tget).prop('disabled', true);
    var omsgb = $(tget).attr('data-msg');
    var noteb = $(tget).attr('data-note');
    var modal_id = $(tget).attr('data-modalid');
    var conf_msg = $(tget).attr('data-confmsg');
    var aftreloadb = $(tget).attr('data-aftreload');
    var isformresetb = $(tget).attr('data-pvntreset');
    var funcCont = $(tget).attr('data-function');
    var noteg = (typeof noteb !== typeof undefined && noteb !== false) ? noteb : 'false';
    var omsg = (typeof omsgb !== typeof undefined && omsgb !== false) ? omsgb : 'modal-out-msg';
    var aftreload = (typeof aftreloadb !== typeof undefined && aftreloadb !== false) ? aftreloadb : "false";
    var isformreset = (typeof isformresetb !== typeof undefined && isformresetb !== false) ? isformresetb : "false";
    var control = $(tget).attr('data-control');
    var formidg = $(tget).attr('data-form');
    var form_data = new FormData($('#' + formidg)[0]);
    if (confirm(conf_msg)) {
        // if (confirm('Are you sure? Your data sent to the server could not be rolled back after you submitted this form.')) {
        $.ajax({
            type: 'post',
            url: baseurl + "/" + control,
            data: form_data,
            dataType: 'json',
            processData: false,
            contentType: false,
            
                
                beforeSend: function () {
                    $('#' + omsg).html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>').show();
                    $('.error').html('');
                    $("#status").fadeIn();
                    $("#preloader").fadeIn();
                },
                success: function (data) {
                    $(tget).prop('disabled', false);
                    var data = eval(data);
                    var outmsg = data.msg;
                    if (data.multi === "true") {
                        $('#' + omsg).html('');
                        $.each(outmsg, function (i, errmsg) {
                            $(`#${i}-error`).html(errmsg);
                        });
                    } else {
                        
                        var msgty = data.err === "false" ? "success" : "danger";
                        var pelmnt = $('#' + omsg).html("<div class='alert alert-" + msgty + "' role='alert'> " + outmsg + " </div>");
                        if (data.err === "false") {
                            retuen_data_ajax = data.returndata;
                            if (funcCont == 'Y') {
                                customFunction();
                            }
                            if(modal_id){
                            setTimeout(
                                function() 
                                {
                                    $('#'+modal_id).modal('toggle');
                                }, 1500);
                            }
                            if (isformreset === "false") { $("#" + formidg)[0].reset(); }
                            $('#datatable').DataTable().ajax.reload();
                            if (aftreload === "true") { location.reload(); }
                            if (noteg === "true") { $('#summernote').summernote("reset"); }
                            pelmnt.show().delay(5000).fadeOut();
                        } else {
                            pelmnt.show().delay(8000).fadeOut();
                        }
                    }
                    $("#status").fadeOut();
                    $("#preloader").fadeOut();
                },
                error: function (jqXHR, exception) {
                    $(tget).prop('disabled', false);
                    $('#' + omsg).html('');
                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
        });
        return false;
    }else{
        $(tget).prop('disabled', "");
    }
});


// validate code startajaxdel
var typingTimer, vldthis;
var doneTypingInterval = 800;

$(document).on('keyup', '.codefvaldid', function () {
    let f = this;
    clearTimeout(typingTimer);
    typingTimer = setTimeout(function () {
        vlidatecode(f);
    }, doneTypingInterval);
});
$(document).on('keydown', '.codefvaldid', function () { clearTimeout(typingTimer); });

var requestSent = false;
function vlidatecode(v) {
    var $input = $(v);
    var codefvald = $input.val();
    var vcont = $input.attr('data-contlr');
    var mincar = $input.attr('data-mincar');
    var getoutb = $input.attr('data-getout');
    var getout = (typeof getoutb !== typeof undefined && getoutb !== false) ? getoutb : 'validstus';
    var iconsb = $input.attr('data-iconsatus');
    var icons = (typeof iconsb !== typeof undefined && iconsb !== false) ? iconsb : 'iconstatus';
    var ists = document.getElementById(icons);
    if (codefvald.trim()) {
        if (codefvald.length > mincar) {
            if (!requestSent) {
                requestSent = true;
                $.ajax({
                    url: baseurl + "/" + vcont,
                    type: 'post',
                    dataType: 'json',
                    data: { codefvald },
                    beforeSend: function () { ists.style.color = "#686464"; ists.innerHTML = "&#xf110"; },
                    success: function (data) {
                        var data = eval(data);
                        if (data.stus === "true") {
                            $input.val(data.msg); ists.innerHTML = "&#xf00c"; ists.style.color = "#4CAF50"; $('#' + getout).val('true');
                        } else { ists.innerHTML = "&#xf00d"; ists.style.color = "#e43e23"; $('#' + getout).val('false'); }
                        requestSent = false;
                    }
                });
            }
        } else {
            ists.innerHTML = "&#xf00d"; ists.style.color = "#e43e23"; $('#' + getout).val('false');
        }
    } else {
        ists.innerHTML = "&#xf104"; ists.style.color = ""; $('#' + getout).val('false');
    }
}
// validate code end
// image preview
var isrc;
var reader = new FileReader();
reader.onload = function (e) {
    var isrcc = (typeof isrc !== typeof undefined && isrc !== false) ? isrc : 'blah';
    document.getElementById(isrcc).src = e.target.result;
}
$(document).on("input", ".proup", function () {
    var input = this;
    isrc = $(input).attr('data-outimg');
    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
});
$(document).on('click', '#blah', function (e) {
    const img = document.getElementById('blah');
    const image = new Image();
    image.src = img.src;
    const w = window.open("");
    w.document.write(image.outerHTML);
    return false;
});
// ajax page load
$(document).on('click', "a[rel='tab']", function () {
    var url = window.location.href;
    var ethis = this;
    pageurl = $(ethis).attr("href");
    if (url !== pageurl) {
        $.ajax({
            url: pageurl + "?rel=tab",
            beforeSend: function () { $('#preloader').fadeIn(); },
            success: function (data) {
                $('#preloader').fadeOut();
                $("#mainapp").html(data);
                window.history.pushState({ path: pageurl }, "", pageurl);
                $(".vertical-nav-menu li a").removeClass("mm-active");
                $(ethis).addClass("mm-active");
            },
            error: function (jqXHR, exception) {
                $('#preloader').fadeOut();
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else { alert("Some error to open this page"); }
            }
        });
    }
    return false;
});
// Delete table
$(document).on("click", ".ajaxdel", function () {
    if (window.confirm("Are You Sure?")) {
        var el = this;
        var delid = el.id;
        var dcontrol = $(el).attr('data-control');
        var table = $(el).attr('data-table');
        var where = $(el).attr('data-where');
      
        $.ajax({
            url: baseurl + "/" + dcontrol,
            type: 'POST', dataType: 'json',
            data: { delid,table,where},
            success: function (data) {
                var data = eval(data);
                if (data.error === "false") {
                    $(el).closest('tr').css('background', '#ff6347').fadeOut(250, function () {
                        $(el).remove();
                    });
                } else { alert(data.msg || "Someting not right,please try again!"); }
            }
        });
    } else { return false; }
});
$(window).on("popstate", function (evt) {
    $.ajax({
        url: location.pathname + '?rel=tab',
        beforeSend: function () { $('#preloader').fadeIn(); },
        success: function (data) { $('#preloader').fadeOut(); $('#mainapp').html(data); },
        error: function (jqXHR, exception) {
            $('#preloader').fadeOut();
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else { alert("Some error to open this page"); }
        }
    });
});

var monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
];

function dateFormat1(d) {
  var t = new Date(d);
  return t.getDate() + ' ' + monthShortNames[t.getMonth()] + ', ' + t.getFullYear();
}