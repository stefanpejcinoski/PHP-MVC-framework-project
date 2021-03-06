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
      
      {if (auth())}
      <a class="nav-item nav-link mr-auto">{$user_data['username']}</a>
      <a class="nav-item nav-link mr-auto" href="{route('logout')}">Logout</a>
      {else}
      <a class="nav-item nav-link active" href="{route('home')}">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="{route('login')}">Login</a>
      <a class="nav-item nav-link" href="{route('register')}">Register</a>
      {/if}
    </div>
  </div>
</nav>
<div class="container">
<div class="text-success">
{messages()}
</div>
<form method="POST" action="{route('search')}">
{csrf()}
<div class="form-group">
<label for="select_user">Select user type</label>
<select class="form-select form-control" id="select_user" name="user-type" aria-label="Default select example">
  {foreach from=$user_types item=type}
  <option value={$type['id']}>{$type['name']}</option>
  {/foreach}
</select>
</div>
<div class="form-group">
<label for="user_search">Search user</label>
    <input class="form-control mr-sm-2" type="search" id="user_search" name="user-name" placeholder="Search" aria-label="Search">
     </div>
    <button class="btn btn-light my-2 my-sm-0" type="submit">Search</button>
      </form>
 

  <div class="d-block text-danger" id="errors">
{errors()}
</div>
</div>
</body>
</html>