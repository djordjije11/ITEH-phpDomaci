<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add a new movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<main class="container fluid">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link home text-info" aria-current="page" href="./index.php">Home</a>
  </li>
</ul>
    <h1 class="mb-4">Add a movie</h1>
    <div class="alert alert-danger" style="display: none;" role="alert" id="movieSavedFalse"></div>
    <div class="alert alert-success" style="display: none;" role="alert" id="movieSavedTrue">
        Success!
    </div>
    
    <div class="mb-4">
    <form>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name">
    </div>
  </div>
  <div class="form-group row">
    <label for="year" class="col-sm-2 col-form-label">Year</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="year">
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
      <textarea placeholder="About movie..." class="form-control" id="description" rows="7"></textarea>
    </div>
  </div>
  <button type="button" id="saveMovie" class="btn btn-info mb-4"
    onclick="addMovie('#name','#year','#description','/ITEH-phpDomaci/Controllers/MovieCreateController.php', '#movieSavedTrue', '#movieSavedFalse')">
      Save a movie
  </button>
</form> 
</div>

</main>
<script src="/ITEH-phpDomaci/Public/Javascript/create.js"></script>
<script src="/ITEH-phpDomaci/Public/Javascript/createMovie.js"></script>
</body>
</html>