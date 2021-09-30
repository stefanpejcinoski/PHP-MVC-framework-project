<html>
<head>
<title>{$appname}-Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">{$appname}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="/login">Login</a>
      <a class="nav-item nav-link" href="/register">Register</a>
    </div>
  </div>
</nav>
<div class="container">
<div class="form-group">
<label for="select_user">Select user type</label>
<select class="form-select" id="select_user" aria-label="Default select example">
  <option selected>Open this select menu</option>
</select>
</div>
<div class="form-group">
<label for="user_search">Search user</label>
    <input class="form-control mr-sm-2" type="search" id="user_search" placeholder="Search" aria-label="Search">
    <button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
  </div>
</div>
</body>
</html>