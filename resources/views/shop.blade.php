<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <title>Shop</title>
</head>

<body>

  <form action="/api" method="POST">
    @csrf
    <div class="container mt-4">

      <h1>Pilih Produk</h1>
      
      
      <input type="hidden" id="price_item" name="price_item" value=""/>
      <div class="select-item mb-3">
        <div class="description" style="float: left; margin:50px;">
          <h3>HP</h3>
          <div>Rp 1.999.000</div>
          <input type="radio" id="hp" onclick="getPrice()" name="product_name" value="HP" />
        </div>
        

        <div class="description" style="float: left; margin:50px;">
          <h3>Tablet</h3>
          <div>Rp 2.999.000</div>
          <input type="radio" id="tablet" onclick="getPrice()" name="product_name" value="Tablet" />
        </div>

        <div class="description" style="float: left; margin:50px;">
          <h3>Aksesoris</h3>
          <div>Rp 99.000</div>
          <input type="radio" id="aksesoris" onclick="getPrice()"  name="product_name" value="Aksesoris" />
        </div>
      </div>

      <div class="mb-3">
        {{-- <label class="form-label">Quantity</label> --}}
        <select name="qty" class="form-select">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
        </select>
      </div>


      <button type="submit" class="btn btn-primary">Checkout</button>
    </div>
  </form>

  <script>
   function getPrice(){
    if(document.getElementById("hp").checked){
      document.getElementById("price_item").value = "1999000";
    }else if(document.getElementById("tablet").checked){
      document.getElementById("price_item").value = "2999000";
    }else if(document.getElementById("aksesoris").checked){
      document.getElementById("price_item").value = "99000";
    }
   }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>