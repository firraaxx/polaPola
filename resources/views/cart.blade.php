@extends('layouts/index')

@section('title', 'My Cart')

@section('container')


<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              @foreach ($order['products'] as $data)

              <tr class="text-center">
                <td class="product-remove">
                  <form action="/hapuscart/{{$order->id}}" method="POST">
                    {{-- {{ method_field('DELETE') }} --}}
                    @csrf
                    <button type="submit"><span class="ion-ios-close"></span></button>
                  </form>
                </td>

                <td class="product-name">
                  <h3>{{$data->product_name}}</h3>
                  <p>{{$data->description}}</p>
                </td>

                <td class="price">Rp .{{$data->price}}</td>

                <td class="quantity">
                  {{$order['quantity']}}
                </td>
                <td class="total">Rp. {{$data->price*$order['quantity']}}</td>
              </tr><!-- END TR-->

              @endforeach
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Bukti Transfer</h3>
          <form action="#" class="info">
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile02">
                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
              </div>
            </div>
          </form>
        </div>
        <p><a href="#" class="btn btn-primary py-2 px-3">Upload</a></p>
      </div>


      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <p class="d-flex">
            <span>Subtotal</span>
            <span>$20.60</span>
          </p>
          <p class="d-flex">
            <span>Delivery</span>
            <span>$0.00</span>
          </p>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span>$17.60</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
  <div class="container py-4">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-md-6">
        <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
        <span>Get e-mail updates about our latest shops and special offers</span>
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <form action="#" class="subscribe-form">
          <div class="form-group d-flex">
            <input type="text" class="form-control" placeholder="Enter email address">
            <input type="submit" value="Subscribe" class="submit px-3">
          </div>
        </form>
      </div>
    </div>
  </div>
</section> -->

@endsection