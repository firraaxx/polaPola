@extends('layouts/index')

@section('container')
<section class="ftco-section">
	<div class="container">
		<form action="{{url('/shop', $product->id)}}" method="POST">
			@csrf
			<div class="row">
				<div class="col-lg-7 mb-5 ftco-animate">
					<a href="{{asset('storage/'. $product->avatar)}}" class="image-popup"><img src="{{asset('storage/'. $product->avatar)}}" class="img-detail" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-5 product-details pl-md-5 ftco-animate">
					<h3>{{$product->product_name}}</h3>
					<p class="price"><span>Rp. {{number_format($product->price, 0)}}</span></p>
					<p>{{ $product->description}}</p>
					<div class="row mt-4">
						{{-- <div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="" id="" class="form-control">
										<option value="">Small</option>
										<option value="">Medium</option>
										<option value="">Large</option>
										<option value="">Extra Large</option>
									</select>
								</div>
							</div>
						</div> --}}
						<div class="w-100"></div>
						<div class="input-group col-md-5 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="quant[1]">
									<i class="ion-ios-remove"></i>
								</button>
							</span>
							<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="quant[1]">
									<i class="ion-ios-add"></i>
								</button>
							</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;">600 kg available</p>
						</div>
					</div>
					<p><a href="{{url('/cart')}}" class="btn btn-black py-3 px-5">Add to Cart</a></p>
					<button type="submit" class="btn btn-primary btn-lg px-5">Beli</button>
				</div>
			</div>
		</form>
	</div>
</section>


<!-- 
	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
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