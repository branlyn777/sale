@section('landingcss')
    <style>
        .card:hover {
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
@endsection

<div class="row">
    <div class="product-active owl-carousel">
        @foreach($products as $p)
            <div class="col-lg-12">
                <!-- single-product-wrap start -->
                <div class="single-product-wrap">
                    <div class="product-image">
                        <a href="landing/single-product.html">
                            <img src="{{ asset('storage/invProducts/' . $p->image) }}" alt="Li's Product Image">
                        </a>
                        <span class="sticker">Nuevo</span>
                    </div>
                    <div class="product_desc">
                        <div class="product_desc_info">
                            <div class="product-review">
                                <h5 class="manufacturer">
                                    <a href="landing/shop-left-sidebar.html">Graphic Corner</a>
                                </h5>
                                <div class="rating-box">
                                    <ul class="rating">
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <h4><a class="product_name" href="landing/single-product.html">{{ $p->name_product }}</a></h4>
                            <div class="price-box">
                                <span class="new-price">50,00 Bs</span>
                            </div>
                        </div>
                        <div class="add-actions">
                            <ul class="add-actions-link">
                                <li class="add-cart active"><a href="landing/#">Añadir Carrito</a></li>
                                <li><a class="links-details" href="landing/wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                                <li><a href="landing/#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- single-product-wrap end -->
            </div>
        @endforeach
    </div>
</div>