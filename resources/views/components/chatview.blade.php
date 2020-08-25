<head>
    <style>
        .form-popup {
  position: fixed;
  bottom: 0;
  right: 15px;
  
  z-index: 9;
}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        function openForm() {
      document.getElementById("myForm").style.display = "block";
      document.getElementById("chat_btn").style.display = "none";
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
      document.getElementById("chat_btn").style.display = "block";
    }
    function get_text(email){
        var d =document.cookie = "other_email="+email;
        $("#msg").prop("value", d);

    
}

    
    </script>
</head>

<div  class="form-popup form-group ">
<form id="myForm" method="POST" action="{{route("Send_text")}}" >
        @csrf
        <h1>Chat</h1>
        <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td><input id="other_user" type="button" class="btn btn-light" name="other_user" onclick="get_text('{{ $user->email }}')" value="{{ $user->email }}"></td>
                    
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">
        <textarea id="msg" class="form-control" rows="10" placeholder="" name="msg" required></textarea>
    
        <button type="submit" class="btn btn-primary">Send</button>
        <button type="button" class="btn btn-primary" onclick="closeForm()">Close</button>
        </div>
    </div>
      </form>
      <button id="chat_btn" type="button" class="btn btn-primary" style="display:none;" onclick="openForm()">Chat</button>
</div>

