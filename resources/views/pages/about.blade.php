@extends('layouts.auth')

@section('title', 'About Us')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="position-relative">
                <img src="{{ asset('images/about.png') }}" class="img-fluid rounded" alt="About Image">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">TRUE TO SKIN</h2>

                    <p class="text-justify">True to skin is a clean and minimalist local skincare brand. Our concept is based on single active ingredient boosted with natural ingredients that result in gentle and effective formulation. Suitable for sensitive skin and pregnancy safe. We source only the highest quality of ingredients and offer them at an affordable price. We are here to set a new standard in beauty with education and transparency as we promise to detail all of our main ingredient formulations down to the specific percentage, to help better educate our customers about what they are truly using and what is truly beneficial to their skin.</p>

                    <p class="text-justify">We deeply believe beauty starts from within. It’s not only about the outside of your skin but also comes from within. Beauty is confidence. We are here to help you reveal your true skin and be comfortable and confident with yourself.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 text-center">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/image 20.svg') }}" alt="Logo" class="img-fluid mr-2" style="max-width: 50px;">
                <p class="mb-0">: <a href="https://www.instagram.com/truetoskinofficial?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">TruetoSkinOfficial</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
