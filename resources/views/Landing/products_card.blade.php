@foreach($products as $p)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="product product-11 text-center">
            <figure class="product-media">
                <a href="{{ route('product.detail', $p->id) }}" style="position: relative; display: block; overflow: hidden;">

                    {{-- Main image --}}
                    <img src="{{ asset('storage/' . $p->image) }}"
                         alt="Product image"
                         class="product-image"
                         style="height: 180px; width: 100%; object-fit: cover; transition: opacity 0.3s ease; display: block;">

                    {{-- Hover image (1st additional image) --}}
                    @php
                        $additionalImages = json_decode($p->additional_images);
                        $hoverImage = isset($additionalImages[0]) ? $additionalImages[0] : null;
                    @endphp

                    @if($hoverImage)
                        <img src="{{ asset('storage/' . $hoverImage) }}"
                             alt="Product image"
                             class="product-image-hover"
                             style="height: 250px; width: 100%; object-fit: cover; position: absolute; top: 0; left: 0; opacity: 0; transition: opacity 0.3s ease;">
                    @endif

                </a>

                <div class="product-action-vertical">
                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <h3 class="product-title">
                    <a href="{{ route('product.detail', $p->id) }}">{{ $p->product_name }}</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    {{ $p->price }} TK
                </div><!-- End .product-price -->
            <!-- End .product-price -->
            </div><!-- End .product-body -->
            <div class="product-action">
                <a href="/cart" class="btn-product btn-cart mr-2" ><span>Add Cart</span></a><br>
                <a href="{{ route('cart-buy_now', $p->id) }}?size={{$p->size}}&qty={{$p->qty}}" class="btn-product btn-cart "><span>Buy Now</span></a>
            </div>
            <!-- End .product-action -->
        </div>
    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
@endforeach
