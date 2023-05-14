$(".side-toggle").click(function () {
  $(".sidebar").toggleClass("hide-sidebar");
  $(".right-content").toggleClass("right-content-0");
});

// search
$(".head-search .input-group-text").click(function () {
  $('.head-search').addClass("open-search");
});
$(".mobile-close-search").click(function () {
  $(".head-search").removeClass("open-search");
});

// table js
$(document).ready(function () {
  $('#example').DataTable({
    language: {
      oPaginate: {
        sNext: '<i class="arrow-icon next-arrow"></i>',
        sPrevious: '<i class="arrow-icon"></i>',
      }
    }
  });
});


function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function displayLoader() {
    $("#dvloader").css('display', 'block');
    $("body").addClass('overlay');
}

function hideLoader() {
    $("#dvloader").css('display', 'none');
    $("body").removeClass('overlay');
}

function delete_record(id, tablename) {
    var result = confirm("Want to delete?");
    if (result) {
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/common/delete_record',
            data: { tablename: tablename, id: id },
            success: function (resp) {
                setTimeout(function () { location.reload(); }, 1500);
            }
        });
    }
}


/************ cghunk video upload ***************/

var baseUrl = jQuery('#base_url').val();
var datafile = new plupload.Uploader({
    runtimes: 'html5,flash,silverlight,html4',
    browse_button: 'uploadFile', // you can pass in id...
    container: document.getElementById('container'), // ... or DOM Element itself
    chunk_size: '1mb',
    url: baseUrl + 'admin/adminDefault/savevideosChunk',
    max_file_count: 1,
    unique_names: true,
    send_file_name: true,
    init: {
        PostInit: function () {
            document.getElementById('filelist').innerHTML = '';
            document.getElementById('upload').onclick = function () {
                datafile.start();
                return false;
            };
        },
        FilesAdded: function (up, files) {
            plupload.each(files, function (file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        UploadProgress: function (up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            if (file.percent > 60) {
                // jQuery('#mp3_file_name').val(file.name);
            }
        },
        FileUploaded: function (up, file) {
            jQuery('#mp3_file_name').val(file.target_name);
        },
        Error: function (up, err) {
            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});

datafile.init();
/***********************************************/
