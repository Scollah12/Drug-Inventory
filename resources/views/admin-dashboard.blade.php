<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        

        <style>
            *{
                margin:0;
                padding:0;
                box-sizing: border-box;
            }
            body{
                background-image: url({{ asset('background.avif') }} );
                background-size: cover;
                overflow-x: hidden; 
                
            }
            :root {
                --bs-tertiary-bg-rgb: 230, 230, 230;
                --bs-bg-opacity: 1; 
            }


           
            .grid-item{
                background-color: #0d6efd;
                width: 200px;
                height: 200px;
                border-radius: 1rem;
                display: flex;
                justify-content: center;
                align-items: center;
            }
 
            .main-container{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .container-1{
                display: grid;
                height: auto;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: 1fr;
                gap: 10rem;
                margin-bottom: 20px;
            }

            .container-2{
                display: grid;
                height: auto;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr;
                gap: 10rem;
            }
            .header{
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
     
           

        </style>
    </head>
    <body>
        <nav class="navbar bg-body-tertiary" aria-label="Light offcanvas navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="#"><img src="{{ asset('logo.jpg') }}" alt="Logo" style="height: 25px;">Dons_Medicos</a>
              <span class="navbar-text text-muted fw-bold" style="font-size: 1rem;">
                "Efficiency In Every Prescription"
              </span>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarLight" aria-controls="offcanvasNavbarLight" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbarLight" aria-labelledby="offcanvasNavbarLightLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasNavbarLightLabel">Offcanvas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href=" {{  route('admin.dashboard') }}">Home</a>
                    </li>
                  
                        
                        
                      <button class="btn btn-primary" onclick="window.location.href='{{ route('notifications.create')}}'">Send Notification to Users</button><br>
                      <button class="btn btn-primary" onclick="window.location.href= '{{ route('login')}}'">Log Out</button>
                    
                  </ul>
                
                </div>
              </div>
            </div>
        </nav>
    <div class="main-container container-animation">
        <div class="header">
            <h1>ADMIN DASHBOARD</h1>
        </div>    
        <div class="container-1 container-animation">
           
        <a href="{{ route('pharmacist.dashboard') }}">
  <div class="grid-item item-1 text-center">
    <i class="fas fa-prescription-bottle-alt" style="font-size: 100px; color: white;"></i>
  </div>
</a>

<a href="{{ route('userdashboard') }}">
  <div class="grid-item item-2 text-center">
    <i class="fas fa-user" style="font-size: 100px; color: white;"></i>
  </div>
</a>

<a href="{{ route('add_user.form') }}">
  <div class="grid-item item-3" style="display: flex; justify-content: center; align-items: center; width: 200px; height: 200px; background-color: #0d6efd; border-radius: 10px;">
    <i class="fas fa-user-plus" style="font-size: 100px; color: white;"></i>
  </div>
</a>
 
          
        </div>
        <div class="container-2 container-animation">
        <a href="{{ route('suppliers.index') }}">
  <div class="grid-item" style="display: flex; justify-content: center; align-items: center; width: 200px; height: 200px; background-color:  #0d6efd; border-radius: 10px;">
    <i class="fas fa-truck" style="font-size: 100px; color: white;"></i>
  </div>
</a>

<a href="{{ route('inventory.dashboard') }}">
  <div class="grid-item" style="display: flex; justify-content: center; align-items: center; width: 200px; height: 200px; background-color: #0d6efd; border-radius: 10px;">
    <i class="fas fa-pills" style="font-size: 100px; color: white;"></i>
  </div>
</a>

        </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>