<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
       @vite(['resources/sass/style.scss', 'resources/js/app.js'])
         <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
   
 @auth

 <section id="nav-bar">
<nav class="navbar navbar-expand-lg bg-body-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand mb-0 h1" href="#">CYB <br> FUTO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item ">
          <form action="/logout" method="POST">
      @csrf
    <button class="btn btn-primary">LOG OUT</button>
    </form>
          
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('student.announcements')}}">Announcements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('student.events')}}" >
            Events
          </a>

        </li>
        <li class="nav-item">
          <a href="{{route('student.timetables')}}" class="nav-link">Timetables</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    </section>
    <section id="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
           <p class="promo-title">Welcome, {{ auth()->user()->name}}! To Cybersecurity Information Board</p>
          <p>Where we keep you updated</p>
          </div>
          <div class="col-md-6 text-center">
            <img src="images/girl.png" class="img-fluid" alt="animation">
          </div>
        </div>
      </div>
      <img src="images/wave1.png" class="bottom-img" alt="wave">
    </section>
 
    <section id="programmes">
      <div class="container text-center">
        <h1 class="title">OVERVIEW</h1>
        <div class="row text-center">
          <div class="col-md-4">
            <img src="/images/movie1.png" class="programmes-img" alt="poster">
            <h4>Upcoming Events</h4>
            <p>The department of Cybersecurity host a CINEMATIC NIGHT Tickets are officially AVAILABLE NOW! 🎬💘
          Secure your seat for a night of love, laughter, match-making, and movie magic under the perfect vibe.  
           It’s Girlfriends’ Day redefined — and YOU need to be there!

         </p>
          </div>
          <div class="col-md-4">
            <img src="/images/cyb.png" class="programmes-img" alt="poster">
            <h4>Educational Events</h4>
            <p>Cybersecurity host a very educative program in collaboration with cisco to educate the young minds on a few technological innovations.</p>
          </div>
          <div class="col-md-4">
            <img src="/images/pic.png" class="programmes-img" alt="poster">
            <h4>School News</h4>
            <p>Futo prepares to receive its students back from the rain semester break and  announces resumption on November 4th.</p>
          </div>
        </div>
      </div>

    </section>

    <section id="social-media">
    <div class="container text-center">
      <p>FIND US ON SOCIAL MEDIA</p>
        <div class="social-icons">
          <a href="#"><img src="images/fb.png" alt="facebook"></a>
          <a href="#"><img src="images/x.png" alt="facebook"></a>
          <a href="#"><img src="images/insta.png" alt="facebook"></a>
        </div>
    </div>
    </section>

    <footer id="footer">
      
      <div class="container">
        <div class="row">
          <div class="col-md-4" footer-box>
           <button class="btn btn-primary">CYB FUTO</button>
<p>Cybersecurity defenders of the cyberspace.
  Both Offensive and Defensive we are your guys.
</p>
          </div>
        </div>
      </div>

    </footer>
       
 @else
 <style>{
    margin:0;
    padding:0;
    box-sizing: border-box;
    font-family: "poppins",sans-serif;
}
body{
    background-color: #c9d6ff;
    background: linear-gradient(to right,#e2e2e2,#c9d6ff);
}
.container{
    background: #fff;
    width:450px;
    padding:1.5rem;
    margin:50px auto;
    border-radius: 10px;
    box-shadow:0 20px 35px rgba(0,0,1,0.9);
}
form{
    margin: 0.1rem;

}
.form-title{
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    padding: 1.3rem;
    margin-bottom: 0.4rem;

}
input{
    color: inherit;
    width: 100%;
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #757575;
    padding-left: 1.5rem;
    font-size: 15px;
}
.input-group{
    padding: 1% 0;
    position: relative; 
}
.input-group i{
    position: absolute;
    color: black;
}
 input:focus{
    background-color: transparent;
    outline: transparent;
    border-bottom: 2px solid hsl(327,90%,28%);
}

input::placeholder{
    color: transparent;
}

label{
    color: #757575;
    position: relative;
    left: 1.2rem;
    top: -1.3rem;
    cursor: auto;
    transition:0.3s ease all;
}

input:focus~label,input:not(:placeholder-shown)~label{
    top: -3em;
    color: hsl(327,90%,28%);
    font-size: 15px;

}

.recover{
    text-align: right;
    font-size: 1rem;
    margin-bottom: 1rem;
}
.recover a{
    text-decoration: none;
    color: rgb(125,125,235);
}

.recover a:hover{
    color: blue;
    text-decoration: underline;

}

.btn{
    font-size: 1.1rem;
    padding: 8px 0;
    border-radius: 5px;
    outline: none;
    border: none;
    width: 100%;
    background-color: rgb(125,125,235);
    color: white;
    cursor: pointer;
    transition: 0.9s;
}
.btn:hover{
    background: #07001f;
}
.or{
    font-size: 1.1rem;
    margin-top: 0.5rem;
    text-align: center;

}
.icons{
    text-align: center;
    justify-content: center;
}
.icons i{
    color: rgb(125, 125, 235);
    padding: 0.8rem;
    padding-left: 1.5rem;
    padding-right: 2.5rem;
    border-radius: 10px;
    font-size: 1.5rem;
    cursor: pointer;
    border: 2px solid #dfe9f5;
    margin: 0 15px;
    transition: 1s;
}
.icons i:hover{
    background: #07001f;
    font-size: 1.6rem;
    border: 2px solid rgb(125, 125, 235);
}
.links{
    display: flex;
    justify-content: space-around;
    padding: 0 4rem;
    margin-top: 0.9rem;
    font-weight: bold;

}
button{
    color: rgb(125, 125, 235);
    border: none;
    background-color: transparent;
    font-size: 1rem;
    font-weight: bold;
}
button:hover{
    text-decoration: underline;
    color: blue;
}</style>
    <div class="container" id="signUp" style="display: none">
      <h1 class="form-title">Register</h1>
      <form method="POST" action="/register">
        @csrf
        <div class="input-group">
          <i class="fas fa-user"></i>
           
          <input
            type="text"
            name="name"
            id="name"
            placeholder="Name"
            required
          />
         <label for="name" class="form-label">Name</label>
        </div>
        
        <div class="input-group">
          <i class="fas fa-envelope"></i>
         
          <input type="email"
           aria-describedby="emailHelp"
            name="email"
            id="email"
            placeholder="example@gmail.com"

          />
          <label for="email">Email</label>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Password"
          />
          <label for="password">Password</label>
          <input type="hidden" name="role" value="student">
        </div>
        <input type="submit" class="btn btn-primary" value="Sign up" name="signUp" />
      </form>
      <p class="or">------------or------------</p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
      </div>
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton" class="btn btn-primary">Sign In</button>
      </div>
    </div>  
    <!--Sign In-->
 <div class="container" id="signIn" >
      <h1 class="form-title">Sign In</h1>
      <form method="POST" action="/login">
        @csrf
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Email"
            required
            value="{{ old('email')}}"
          />
          <label for="email">Email</label>
        @error('email')
       <p>{{ $message }}</p>
        @enderror

        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="password"
            required
          />
          <label for="password">Password</label>
        </div>

        @error('password')
       <p>{{ $message }}</p>
        @enderror

        <p class="recover">
          <a href="#">Recover Password</a>
        </p>
        <input type="submit" class="btn btn-primary" value="Sign In" name="signIn" />
      </form>
      <p class="or">---------or-------</p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
      </div>
      <div class="links">
        <p>Don't Have Account Yet ?</p>
        <button id="signUpButton" class="btn btn-primary">Sign Up</button>
      </div>
    </div>
    <script>
  const signUpButton=document.getElementById('signUpButton');
const signInButton=document.getElementById('signInButton');
const signInForm=document.getElementById('signIn');
const signUpForm=document.getElementById('signUp');

signUpButton.addEventListener('click',function(){
    signInForm.style.display="none";
    signUpForm.style.display="block";
})
signInButton.addEventListener('click', function(){
    signInForm.style.display="block";
    signUpForm.style.display="none";
})
 </script>
 @endauth
  
</body>
</html>