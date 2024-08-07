@extends('index::layouts.master')

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html"> صفحه ای اصلی </a>
                    </li>
                    <li class="active"> سبد خرید</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="alert alert-success fade" id="increase-result"></div>
    <div class="cart-main-area pt-95 pb-100 text-right" style="direction: rtl;">
        @if(empty($cartItems))
            <div class="container cart-empty-content">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <i class="sli sli-basket"></i>
                        <h2 class="font-weight-bold my-4">سبد خرید خالی است.</h2>
                        <p class="mb-40">شما هیچ کالایی در سبد خرید خود ندارید.</p>
                        <a href="shop.html"> ادامه خرید </a>
                    </div>
                </div>
            </div>
        @else
            <div class="container cart">
                <h3 class="cart-page-title"> سبد خرید شما </h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                        <form action="#">
                            <div class="table-content table-responsive cart-table-content">
                                <table>
                                    <thead>
                                    <tr>
                                        <th> تصویر محصول</th>
                                        <th> نام محصول</th>
                                        <th> قیمت</th>
                                        <th>تعداد</th>
                                        <th>قیمت با تخفیف</th>
                                        <th>ویژگی - مقدار</th>
                                        <th> عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cartItems as $variantId => $cartItem)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="{{ $cartItem['image'] }}" alt="" width="140"
                                                                 height="140"></a>
                                            </td>
                                            <td class="product-name"><a href="#"> {{ $cartItem['name'] }} </a></td>
                                            <td class="product-price-cart">
                                                <span
                                                    class="amount">{{ number_format($cartItem['price']) }} تومان </span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="qtybutton"
                                                           value="{{ $cartItem['quantity'] }}">
                                                </div>
                                            </td>
                                            <td class="product-name"><a href="#">
                                                    {{ array_key_exists('sale_price',$cartItem) ? number_format($cartItem['sale_price']) . "تومان" : "-" }}
                                                </a></td>
                                            <td class="product-subtotal">{{ $cartItem['attribute']  }}
                                                - {{ $cartItem['attribute_value'] }}</td>
                                            <td class="product-remove">
                                                <a href="{{ route('cart.remove', ['variation' => $variantId]) }}" data-variation-id="{{ $variantId }}"><i
                                                        class="sli sli-close"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="#"> ادامه خرید </a>
                                        </div>
                                        <div class="cart-clear">
                                            <!-- <button> به روز رسانی سبد خرید</button> -->
                                            <a href="{{ route('cart.clear') }}"> پاک کردن سبد خرید </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row justify-content-between">

                            <div class="col-lg-4 col-md-6">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray"> کد تخفیف </h4>
                                    </div>
                                    <div class="discount-code">
                                        <p> لورم ایپسوم متن ساختگی با تولید سادگی </p>
                                        <form>
                                            <input type="text" required="" name="name">
                                            <button class="cart-btn-2" type="submit"> ثبت</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-12">
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart"> مجموع سفارش </h4>
                                    </div>
                                    <br>
                                    <h6>
                                        لیست سفارشات:
                                        <br><br>
                                        <table class="table-bordered col-12">
                                            <th>عنوان</th>
                                            <th>قیمت</th>
                                            <th>تعداد</th>
                                            <th>قیمت کل</th>
                                            @foreach(session()->get('cart') as $item)
                                                <tr>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>
                                                        @if(isset($item['sale_price']))
                                                            {{ number_format($item['sale_price']) }} تومان
                                                        @else
                                                            {{ number_format($item['price']) }} تومان
                                                        @endif
                                                    </td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ number_format($item['totalPrice']) }} تومان</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </h6>
                                    <h5>
                                        مبلغ سفارش :
                                        <span>
                                            {{ number_format(session()->get('totalCartPrice')) }}
                                            تومان
                                        </span>
                                    </h5>
                                    <div class="total-shipping">
                                        <h5>
                                            هزینه ارسال :
                                            <span>
                                                 {{ number_format(30000) }}
                                                تومان
                                            </span>
                                        </h5>

                                    </div>
                                    <h4 class="grand-totall-title">
                                        جمع کل:
                                        <span>
                                            {{ number_format(session()->get('totalCartPrice') + 30000)  }}
                                            تومان
                                        </span>
                                    </h4>
                                    <a href="./checkout.html"> ادامه فرآیند خرید </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif


    </div>
@endsection
@section('scripts')
    <script>
        const addToCartSection = document.querySelector("#start-modal");
        const selectedVariant = document.querySelector("#selected-variant");
        const increaseQuantity = document.querySelector('.cart')
        increaseQuantity.addEventListener("click", function (e) {

            if (e.target.classList.contains('inc')) {
                console.log(e.target.parentElement.parentElement.parentElement.children[6].children[0].attributes[1])
                let variantId = e.target.parentElement.parentElement.parentElement.children[6].children[0].attributes[1].value;
                let route = `{{ route('cart.increase', ['variation' => ':variation']) }}`
                route = route.replace(':variation', variantId)

                const IncreaseQuantityXhr = new XMLHttpRequest();
                IncreaseQuantityXhr.open('GET', route)
                IncreaseQuantityXhr.send();

                IncreaseQuantityXhr.addEventListener("load", function () {
                    const increaseResult = document.querySelector("#increase-result");
                    increaseResult.classList.remove('fade');
                    let response = JSON.parse(IncreaseQuantityXhr.response);
                    console.log(response);
                    increaseResult.innerHTML = response.message;
                    if (response.data !== "") {
                        window.location.reload();
                    }
                });
            }
        });

        window.addEventListener('load', function () {
            loadCartItems();
        })

        function setCartItemsCountBadge(items) {
            const cartItemsCount = document.querySelector('span[class="count-style"]');
            cartItemsCount.innerText = Object.keys(JSON.parse(items).data).length;
        }

        function loadCartItems() {
            const cartItemsXhr = new XMLHttpRequest();
            cartItemsXhr.open('GET', `{{ route('cart.items') }}`);
            cartItemsXhr.send();

            cartItemsXhr.onload = function () {

                if (JSON.parse(this.response).data != null) {
                    setCartItemsCountBadge(this.response);

                    let cartItemsSidebar = document.querySelector("#cartItemsHeader");
                    let totalPriceSection = document.querySelector(".shop-total");
                    let cartItems = JSON.parse(this.response);
                    let cart;
                    let totalAmount = 0;

                    for (item in cartItems.data) {
                        totalAmount += cartItems.data[item].price;
                        cart += `
                    <li class="single-shopping-cart">
                        <div class="shopping-cart-title">
                            <h4><a href="#"> ${cartItems.data[item].name} </a></h4>
                            </div>

                         <div class="shopping-cart-img">
                             <a href="#">
                                <img alt="" src="${cartItems.data[item].image}"  style="width: 60px; height: 60px;"/>
                             </a>
                             <div class="item-close">
                                <a href="#"><i class="sli sli-close"></i></a>
                             </div>
                         </div>
                    </li>`
                    }
                    cartItemsSidebar.innerHTML = cart;
                    totalPriceSection.innerHTML = totalAmount.toLocaleString() + " تومان";
                }
            }
        }
    </script>
@endsection
