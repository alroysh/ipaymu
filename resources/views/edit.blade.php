<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Edit</title>
</head>
<body>
    
  <form action="/update" method="POST">
    @csrf
    <div class="container mt-4">
      @foreach($users as $p)
      <input type="hidden" name="id" value="{{ $p->id }}">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{ $p->name }}" placeholder="John Doe" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Pekerjaan</label>
        <input type="text" class="form-control" name="jobs" value="{{ $p->jobs }}" placeholder="Buruh" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" value="{{ $p->birthdate }}" name="birthdate" required>
      </div>
      @endforeach
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>