<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            overflow-x: hidden;
        }
        :root {
            --bs-tertiary-bg-rgb: 230, 230, 230;
            --bs-bg-opacity: 1;
        }
        .grid-item {
            background-color: #0d6efd;
            width: 200px;
            height: 200px;
            border-radius: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .main-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .container-1, .container-2 {
            display: grid;
            height: auto;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
            gap: 10rem;
            margin-bottom: 20px;
        }
        .container-2 {
            margin-bottom: 0;
        }
        .header {
            margin: 30px;
            background-color: #e6e6e6;
            width: 1000px;
            border-radius: 1rem;
            display: flex;
            justify-content: center;
        }
        .container-animation {
            opacity: 0;
            transform: scale(0.5);
            animation: fadeInScale 0.8s ease-out forwards;
        }
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .video-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            object-fit: fill;
            z-index: -1;
            pointer-events: none;
        }
        .main-content {
            position: relative;
            z-index: 1;
        }
        #chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 9998;
            font-family: sans-serif;
        }
        #chatbot-header {
            background-color: #0d6efd;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #chatbot-messages {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
            max-height: 300px;
            font-size: 14px;
        }
        #user-input {
            width: 100%;
            border: none;
            border-top: 1px solid #ccc;
            padding: 10px;
            outline: none;
        }
    </style>
</head>
    <body>
      <video autoplay muted loop class="video-bg">
      <source src="{{ asset('inventoryvideos/rotating_pills.mp4') }}" type="video/mp4">
      
      </video>

      <div class="main-content">


        <nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
          <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.html"><img src="{{ asset('logo.jpg') }}" alt="logo" style="height: 25px;">Dons_Medicos</a>
            <span class="navbar-text text-muted fw-bold" style="font-size: 1rem;">
              "Efficiency In Every Prescription"
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
              <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel"><img src="{{ asset('logo.jpg') }}" alt="logo" style="height: 25px;">Dons_Medicos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('medicine.create') }}">Add Medicine</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('view.medicine') }}">View Medicine</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('medicine.update') }}">Update Medicine</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('medicines.expiry') }}">Expiring/Expired Medicine</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('delete_medicine') }}">Delete Medicine</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('inventory.dashboard') }}">Anomally Report</a>
                  </li>
                  
                </ul>
               
              </div>
            </div>
          </div>
      </nav>
    <div class="main-container container-animation">
        <div class="header">
            <h1>INVENTORY DASHBOARD</h1>
        </div>    
        <div class="container-1 container-animation">
           
            <a href="{{ route('medicine.create') }}"><div class="grid-item item-1"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg></div></a>
            <a href="{{ route('view.medicine') }}"><div class="grid-item item-2"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-clipboard-data-fill" viewBox="0 0 16 16">
                <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1"/>
              </svg></div></a>
            <a href="{{ route('medicine.update') }}"><div class="grid-item item-3"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-repeat" viewBox="0 0 16 16">
              <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192m3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
            </svg></div></a>
            
          
        </div>
        <div class="container-2 container-animation">
                <a href="{{ route('medicines.expiry') }}"><div class="grid-item"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-hourglass-split" viewBox="0 0 16 16">
                  <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                </svg></div></a>
                <a href="{{ route('delete_medicine') }}"><div class="grid-item"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                </svg></div></a>
                <a href="{{ route('anomaly.report') }}">
                  <div class="grid-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="white" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                      <path d="M8.982 1.566a1.13 1.13 0 0 0-1.964 0L.165 13.233c-.457.778.091 1.767.982 1.767h13.707c.89 0 1.438-.99.982-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1-2.002 0 1 1 0 0 1 2.002 0z"/>
                    </svg>
                  </div>
                </a>
                
        </div>
        
      
     </div>

     
<div id="chatbot-icon" onclick="toggleChat()" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; cursor: pointer; background-color: #0d6efd; border-radius: 50%; padding: 12px;">
  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" class="bi bi-robot" viewBox="0 0 16 16">
      <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5M3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.6 26.6 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.93.93 0 0 1-.765.935c-.845.147-2.34.346-4.235.346s-3.39-.2-4.235-.346A.93.93 0 0 1 3 9.219zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a25 25 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25 25 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135"/>
      <path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2zM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5"/>
  </svg>
</div>


<div id="chatbot-container" style="position: fixed; bottom: 10px; right: 10px; width: 300px; background: #fff; border: 1px solid #ccc; display: flex; flex-direction: column; z-index: 999;">
    <div id="chatbot-header" style="background: #007bff; color: white; padding: 10px;">
        <span>Chatbot</span>
        <button onclick="toggleChat()" style="background: none; border: none; color: white; float: right;">X</button>
    </div>
    <div id="chatbot-messages" style="height: 200px; overflow-y: scroll; padding: 10px;"></div>
    <input type="text" id="user-input" placeholder="Type: anomalies, low stock, expiring" onkeypress="sendMessage(event)" style="border-top: 1px solid #ccc; padding: 10px;">
</div>

<script>
    function toggleChat() {
        var chat = document.getElementById("chatbot-container");
        chat.style.display = (chat.style.display === "none" || chat.style.display === "") ? "flex" : "none";
    }

    function sendMessage(event) {
        if (event.key === "Enter") {
            var input = document.getElementById("user-input");
            var msg = input.value.trim();
            if (msg === "") return;

            var chatBox = document.getElementById("chatbot-messages");
            chatBox.innerHTML += "<b>You:</b> " + msg + "<br/>";

            fetch("{{ route('chatbot.handle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: "msg=" + encodeURIComponent(msg)
            })
            .then(response => response.text())
            .then(data => {
                chatBox.innerHTML += "<b>Bot:</b> " + data + "<br/><br/>";
                chatBox.scrollTop = chatBox.scrollHeight;
            });

            input.value = "";
        }
    }
</script>

      
      
    </body>
</html>