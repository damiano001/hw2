<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
      <a href="{{ route('search') }}"><i class="fas fa-search" ></i></a>
      <a href="{{ route('profile') }}"><i class="fas fa-user"></i></a>
      <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </header>
  
  <h2 style="margin: 20px">Your posts</h2>
  
  <div class="feed-container">
    <div class="feed">
      @foreach ($posts as $post)
        <div class="post">
          <h3>{{ $post->username }}</h3>
          <p>{{ $post->post_content }}</p>          
          @if ($post->post_image)
            <img src="{{ $post->post_image }}" alt="Post Image">  
          @endif
          <p>{{ $post->created_at }}</p>
          
        </div>
      @endforeach
    </div>
  </div>
</body>
</html>
