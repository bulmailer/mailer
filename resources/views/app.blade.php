<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!--
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

<script>
    function loadHistory(del = null, from = null) {
    //let url = 'http://localhost:8888/mailer_app/public/api/get-history?username='+document.getElementById('username').value+'&del='+del+'&from='+from;
    let url = 'http://mybmail.herokuapp.com/api/get-history?username='+document.getElementById('username').value+'&del='+del+'&from='+from;
        let http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function() {
            document.getElementById('thebody').innerHTML = ``;
            if(http.readyState == 4 && http.status == 200) {
            let key = 0;
            const {nav , prev, next } = JSON.parse(this.responseText.replace(/<!DOCTYPE HTML>/g, '')).meta;
            
            if(nav){
                document.getElementById('paginate').style.display = "block";
                document.getElementById('nextval').value = next;
                document.getElementById('prevval').value = prev;
                if(prev == 0 && ((next - 10) == 0 )) {
                    document.getElementById('prev').classList.add("disabled");
                } else {
                    document.getElementById('prev').classList.remove("disabled");
                }
                
                if(next == 0) {
                    document.getElementById('next').classList.add("disabled");
                } else {
                    document.getElementById('next').classList.remove("disabled");
                }
                
            } else {
                document.getElementById('paginate').style.display = "none";
            }
            JSON.parse(this.responseText.replace(/<!DOCTYPE HTML>/g, '')).data.forEach(element => {
                const {id, subject, addresses, failed } = element;
                key++
                document.getElementById('thebody').innerHTML += `<tr>
                <td width="5px" onclick='populateform(${JSON.stringify(element).replace(/'/g,"++")})' style="cursor:pointer"><i style="color: #23527c " class="fa fa-edit"></i> ${addresses.split(",").length}</td>
                <td style="white-space:nowrap; width: 200px; overflow: auto">${subject}</td>
                <td onclick='populateform(${JSON.stringify(element).replace(/'/g,"++")}, true)' style="cursor:pointer">${failed !== '' ? `<i style="color: #23527c " class="fa fa-refresh"></i> ${failed.split(",").length}` : 0}</td>
                <td><a href="#" onclick="document.getElementById('todel').value =${id};document.getElementById('id01').style.display='block';" style="color: #d9534f "><i class="fa fa-trash"></i></a></td>
                </tr>`;
            });
            
            
            }
        }
        http.send();  
    }

    function populateform(data, failed_add = false){
        const {from, subject, addresses, mail, failed, company } = data;
        
        document.getElementById('inputEmail4').value = from.replace("++", "'");
        document.getElementById('inputsubject').value = subject.replace("++", "'");
        document.getElementById('inputAddress').value = failed_add ? failed : addresses;
        document.getElementById('inputCity').value = ",";
        document.getElementById('inputAddress2').value =  mail.replace("++", "'");
        document.getElementById('inputZip').value = company.replace("++", "'");
        tinyMCE.activeEditor.setContent(mail.replace("++", "'"));
        csv();
    }

    function clearStatus(){
        //let url = "http://localhost:8888/mailer_app/public/api/clear-status";
        let url = "http://mybmail.herokuapp.com/api/clear-status";
        let params = "";
        params += "statusId="+document.getElementById('statusid').value;
        let http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                location.reload();
            }
        }
        http.send(params);
        


        return false;
        
    }
</script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({
    selector:'#inputAddress2',
    /*
    toolbar: 'customInsertButton customDateButton',
  setup: function (editor) {

    editor.ui.registry.addButton('customInsertButton', {
      text: 'My Button',
      onAction: function (_) {
        editor.insertContent('&nbsp;<strong>It\'s my button!</strong>&nbsp;');
      }
    });

    var toTimeHtml = function (date) {
      return '<time datetime="' + date.toString() + '">' + date.toDateString() + '</time>';
    };

    editor.ui.registry.addButton('customDateButton', {
      icon: 'insert-time',
      tooltip: 'Insert Current Date',
      disabled: true,
      onAction: function (_) {
        editor.insertContent(toTimeHtml(new Date()));
      },
      onSetup: function (buttonApi) {
        var editorEventCallback = function (eventApi) {
          buttonApi.setDisabled(eventApi.element.nodeName.toLowerCase() === 'time');
        };
        editor.on('NodeChange', editorEventCallback);

        return function (buttonApi) {
          editor.off('NodeChange', editorEventCallback);
        };
      }
    });
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  */
    });
</script>


        <style>
            body {
                font-family:Arial, Helvetica, sans-serif;
            }
            .tox-notification--warning{
                display: none !important;
            }
            * {box-sizing: border-box}
            

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  float: left;
  width: 50%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: #ccc;
  color: black;
}

/* Add a color to the delete button */
.deletebtn {
  background-color: #f44336;
}

/* Add padding and center-align text to the container */
#id01 .container {
  padding: 16px;
  text-align: center;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 3; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and delete button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
    width: 100%;
  }
}
        </style>
    </head>
    <body onload="loadHistory()" class="antialiased">
    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" >
            <input type="hidden" id="todel"/>
            <div class="container">
            <h1>Delete Mail</h1>
            <p>Are you sure you want to delete this?</p>

            <div class="clearfix">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="button" onclick="loadHistory(document.getElementById('todel').value);document.getElementById('id01').style.display='none'" class="deletebtn">Delete</button>
            </div>
            </div>
        </form>
    </div>
    <div id='overlay' class="flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0" style="background: rgba(0,0,0, 0.6); height: 100%; width:100%; position:fixed; top: 0; z-index: 3; left:0; display:none;">  
   
    <table style="width: 50%">
        <tr style="width: 100%">
            <td style="width: 100%">
            <center>
                <span id="sendingload"><i style="font-size: 70px; color: #23527c" class="fa fa-spinner fa-pulse"></i></span>
            </center>
            </td>
        </tr>
        <tr>
            <td>
                <div class="progress" style="width: 100%; margin-top:20px">
                    <div id="progresscount" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                    aria-valuemin="0" aria-valuemax="100" style="width:40%">
                       Sending... 40% Complete
                    </div>
                </div>
            </td>
        </tr>
        <tr style="width: 100%">
            <td style="width: 100%">
            <center>
            <div id="donebutton" style="display: none;">
                <input type="hidden" id="statusid"/>
                <button type="submit" onclick="clearStatus()" class="btn btn-dark btn-block">Done</button>
            </div>
            </center>
            </td>
        </tr>
    </table>
        
        
    </div>
    <nav class="navbar navbar-light navbar-expand-lg mb-2" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">Bulk Mailer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
        -->
                    @else
                    @if (Route::currentRouteName() != 'dashboard-form')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard-form') }}">Mailer</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
        <!--<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">-->
        <div class="relative items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="container">
            @yield('content')
        </div>
        
        </div>
        <div style="background: #191919; width:100%; position:fixed; bottom: 0; z-index: 1; left:0;"> 
        <div style="height: 10px;">&nbsp;</div>
            <table class="footer"  align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="content-cell" align="center" style="font-size: 12px; color: #f7fafc">
                    © {{ date('Y') }} {{ 'BulkMailer' }}. @lang('All rights reserved.')
                    </td>
                </tr>
            </table>
            <div style="height: 10px;">&nbsp;</div>
        </div> 

    </body>
</html>