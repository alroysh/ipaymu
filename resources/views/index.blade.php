<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Halaman Utama</title>
</head>
<body>


    <div class="container mt-4">
        
        @if(session()->has('success'))
  
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <div class="alert-body">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              {{-- <span>&times;</span> --}}
            </button>
      
            {{ session('success') }}
          </div>
        </div>
        @elseif(session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <div class="alert-body">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              {{-- <span>&times;</span> --}}
            </button>
        
            {{ session('failed') }}
          </div>
        </div>
      @endif

        <div class="row">
            <div class="col-md-6">
                <a href="/add">
                    <button type="button" class="btn btn-primary btn-icon">
                      <i class="fas fa-plus"></i> Tambah
                    </button></a>
                </div>
            
        <div class="col-md-6">
          <form action="/" method="GET" class="form-inline mr-auto">
            <div class="input-group mb-2">
              <input type="text" name="search" value="{{ request('search')}}" class="form-control" placeholder="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            </div>
        </div>

        <a href="/shop">iPaymu Payment Gateaway</a>
        <div class="row mt-4">
            <div class="col-md-5 mb-5" >
                <form action="/dateFilter" method="get" class="form-inline">
                  <select name="filter" class="form-select">
                    <option value="genap">Genap</option>
                    <option value="ganjil">Ganjil </option>
                  </select>
                  <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        
        @if(isset($filter))
        <h2>Tanggal {{ $filter }}</h2>
        @endif
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Pekerjaan</th>
              <th>Tanggal Lahir</th>
              <th>Opsi</th>
            </tr>
            @foreach($users as $p)
                    
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $p->name }}</td>
              <td>{{ $p->jobs }}</td>
              <td>{{ $p->birthdate }}</td>
              <td> 
                <button class="btn btn-warning" type="button">
                    <a class="dropdown-item has-icon" href="/edit/{{ $p->id}}">Update</a>
                  </button>
                  <button class="btn btn-danger" type="button">
                    <a class="dropdown-item has-icon" href="/delete/{{ $p->id}}"></i>Delete</a>
                  </button>
               
              </td>

            </tr> 
            @endforeach
          </table>
        </div>
        
        
        @if(isset($filter))
            
        @else
                <div class="pagination justify-content-end"> 
            {{ $users->links() }}
          </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>