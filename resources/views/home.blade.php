<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" >
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/giphy.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="{{ asset('js/home.js') }}" defer></script>
  <script src="{{ asset('js/giphy.js') }}" defer></script>
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
  
  <div class="post-form">
    <form method="post" enctype="multipart/form-data" action="{{ route('post.create') }}">
      @csrf
      <textarea name="post_content" placeholder="What's on your mind?"></textarea>
      <input type="file" name="post_image" id="post-image-input" accept="image/*,video/gif">
      <input type="hidden" name="selected_gif_url" id="selected-gif-url">
      <label for="post-image-input">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1156px-Picture_icon_BLACK.svg.png" style="height: 35px; width:40px; margin-right: 10px; cursor: pointer">
      </label>
      <img class="giphy-icon" src="https://cdn.icon-icons.com/icons2/2699/PNG/512/giphy_logo_icon_168175.png" style="height: 38px; width:87px; margin-right: 10px; cursor:pointer" onclick="openGiphyModal()">

      <button type="submit" name="post">Post</button>

      <!-- Modale GIPHY -->
      <div class="giphy-modal">
        <div class="modal-content">
          <span class="close-modal">&times;</span>
          <div class="gifs-container"></div>
        </div>
      </div>
    </form>
  </div>
  
  <div class="feed-container">
    <div class="feed">
    </div>
  </div>
</body>
</html>
