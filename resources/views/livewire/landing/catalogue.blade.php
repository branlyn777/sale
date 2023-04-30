@section('landingcss')
    <style>
        .card:hover {
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
@endsection
<div>


    <div class="container px-2 my-2">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Catálogo Productos</span></h1>
        </div>
        <div class="row justify-content-center">


          @foreach($products as $p)
          <div class="col-12 col-sm-6 col-md-3">
              <div class="card">
                  <img src="https://s3-hc-files-prod.s3.amazonaws.com/wp-content/uploads/2022/11/VNE-LX3X6SAZ_1PP.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <h5 class="card-title">{{ $p->name_product }}</h5>
                      <p class="card-text">{{ $p->description }}</p>
                      <a href="#" class="btn btn-primary">Comprar</a>
                  </div>
              </div>
          </div>
          @endforeach


        </div>
    </div>

</div>
