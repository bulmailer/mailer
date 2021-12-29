@extends('app')

@section('content')

<div class="container row">
  <div class="col-8">
    <form onsubmit="return sendMail(this)" >
    <input type="hidden" value="{{ $user->email }}" id="username"/>
      <div class="form-row row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">From Email</label>
          <input type="email" class="form-control" id="inputEmail4" placeholder="Email" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputsubject">Subject</label>
          <input type="text" class="form-control" id="inputsubject" placeholder="Subject" required>
        </div>
      </div>
      <div class="form-group">
        <label for="inputAddress">Recipient Emails</label>
        <textarea class="form-control" onchange="csv()" id="inputAddress" rows="3" required></textarea>
      </div>
      <div class="form-row row">
        <div class="form-group col-md-4">
          <label for="inputCity">Separator</label>
          <input type="text" class="form-control" value="," onchange="csv()" id="inputCity" required>
        </div>
        <div class="form-group col-md-4">
          <label for="inputState">Preview Recipients</label>
          <select id="inputState" class="form-control">
            <option value="">Emails: 0</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="inputZip">Company Name</label>
          <input type="text" class="form-control" id="inputZip" required>
        </div>
      </div>
      <div class="form-group">
        <label for="codeinput">Code</label>
        <textarea class="form-control" id="codeinput" rows="10" placeholder="<CODE></CODE>" onchange="
        let inp = this.value.replace(/sp;/g, `<span style='display:none'> _</span>`);
        inp = inp.replace(/&nb/g, `<span style='display:none'> _</span>`);
         tinyMCE.activeEditor.setContent(inp)"></textarea>
      </div>
      <div class="form-group">
        <label for="inputAddress2">Mail</label>
        <textarea class="form-control" id="inputAddress2" rows="10"></textarea>
      </div>
      
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck" required>
          <label class="form-check-label" for="gridCheck">
            Are you sure?
          </label>
        </div>
      </div>
      <button id="sendbut" type="submit" disabled class="btn btn-primary">Send</button>
    </form>
  </div>
  <div class="col-4" style="border-left: 2px solid rgba(0, 0, 0, 0.075);">
  <h5>Mail list</h5>
  <table style="table-layout:fixed; width:120%;" class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Failed</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody id="thebody">
    </tbody>
  </table>
  
  </div>
  <nav id="paginate" style="display: none" aria-label="Page navigation example">
  <input type="hidden" id="nextval"/>
  <input type="hidden" id="prevval"/>
  <ul class="pagination justify-content-end">
    <li id="prev" class="page-item">
      <a class="page-link" onclick="loadHistory(null, document.getElementById('prevval').value)" href="#" tabindex="-1">Previous</a>
    </li>
    <!--
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
-->
    <li id="next" class="page-item">
      <a  class="page-link" onclick="loadHistory(null, document.getElementById('nextval').value)" href="#">Next</a>
    </li>
  </ul>
</nav>
<hr>

</div>
<div class="container row">
  
  
</div>


@endsection
<script>
  const csv = () => {
    let comma_seperated = document.getElementById('inputAddress').value;
    let sepearator = document.getElementById('inputCity').value;
    let emails = comma_seperated.trim() !== '' ? comma_seperated.split(sepearator) : [];
    document.getElementById('inputState').innerHTML = `<option value="">Emails: ${emails.length}</option>`;
    emails.forEach(element => {
      document.getElementById('inputState').innerHTML += `<option value="${element.trim()}">${element.trim()}</option>`;
    });
    if(emails.length > 0){
      document.getElementById('sendbut').disabled = false;
    } else {
      document.getElementById('sendbut').disabled = true;
    }
  }

  function sendMail(val){
        document.getElementById('sendbut').disabled = true;
        document.getElementById('overlay').style.display = "flex";
        document.getElementById('progresscount').style.width = "0%";
        document.getElementById('progresscount').innerText = "Sending... 0% Complete";
        let form = val;
        let url = "http://localhost:8888/mailer_app/public/api/send-mail";
        let comma_seperated = document.getElementById('inputAddress').value;
        let sepearator = document.getElementById('inputCity').value;
        let params = `from=${
          document.getElementById('inputEmail4').value
        }&mail=${
          tinyMCE.activeEditor.getContent()
        }&subject=${
          document.getElementById('inputsubject').value
        }&company_name=${
          document.getElementById('inputZip').value
        }&username=${document.getElementById('username').value
        }&addresses=${comma_seperated.split(sepearator).map(element => {
          return element.trim()
        })}`

        let http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {
                const {id} = JSON.parse(this.responseText.replace(/<!DOCTYPE HTML>/g, '')).status;
                let startInterval = setInterval(updateStatus, 3000);
                function updateStatus() {
                let url = 'http://localhost:8888/mailer_app/public/api/get-status?statusId='+id;
                  let http = new XMLHttpRequest();
                  http.open("GET", url, true);
                  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  http.onreadystatechange = function() {
                      if(http.readyState == 4 && http.status == 200) {
                        const {percentage} = JSON.parse(this.responseText.replace(/<!DOCTYPE HTML>/g, '')).status
                        document.getElementById('progresscount').style.width = `${percentage}%`;
                        document.getElementById('progresscount').innerText = `Sending... ${percentage}% Complete`;
                        if(percentage == 100) {
                          document.getElementById('sendingload').innerHTML = `<i style="font-size: 70px; color: #23527c" class="fa fa-check-circle"></i>"`;
                          document.getElementById('progresscount').innerText = `${percentage}% Complete`;
                          document.getElementById('donebutton').style.display = "block";
                          clearInterval(startInterval);
                        }
                      }
                  }
                  http.send();  
              }
            }
        }
        http.send(params);
        return false;   
    }
    
    
</script>