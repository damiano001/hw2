<!DOCTYPE html>
<html>
<head>
    <title>User Search</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" >
</head>
<body>
   <header class="header">
       <div class="logo">
           <img src="https://st2.depositphotos.com/5142301/7567/v/950/depositphotos_75676827-stock-illustration-abstract-green-leaf-sphere-logo.jpg">
           <span class="network-name" style="font-size: 24px; margin-left: 30px;position: absolute; margin-top: 5px;">Social Network</span>
       </div>

       <div class="profile-icons">
           <a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
           <a href="{{ route('search') }}"><i class="fas fa-search"></i></a>
           <a href="{{ route('profile') }}"><i class="fas fa-user"></i></a>
           <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
           
       </div>
   </header>

   <div style="display: flex; flex-direction: column; align-items: center; margin: 20px;">
       <h1>User Search</h1>

       <form action="{{ route('search') }}" method="GET">
           <input type="text" name="search" placeholder="Enter username" required>
           <button type="submit" >Search</button>
       </form>
   </div>

   @if (isset($searchResults))
       <h2 >Search Results:</h2>
       @if (empty($searchResults))
           <p >No users found with the given username.</p>
       @else
           <ul >
               @foreach ($searchResults as $user)
                   <li >
                       {{ $user->username }}
                   </li>
               @endforeach
           </ul>
       @endif
   @endif
</body>
</html>
