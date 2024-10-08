@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection

@section('content')
    <!-- Page Content -->
    <div class="page-content page-details">
      <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/">Home</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Product Details
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image" alt="" />
              </transition>
            </div>
            <div class="col-lg-2">
              <div class="row">
                <div v-for="(photo, index) in photos" :key="photo.id" class="col-3 col-lg-12 mt-2 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
                  <a href="#" @click="changeActive(index)">
                    <img :src="photo.url" class="w-100 thumbnail-image" :class="{ active: index == activePhoto }" alt="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
          <div class="container">
            <div class="row">
              <div class="col-lg-8">
                <h1>{{ $products->name }}</h1>
                <div class="owner">By {{ $products->user->store_name }}</div>
                <div class="price">Rp{{ number_format($products->price) }}</div>
              </div>
              <div class="col-lg-2" data-aos="zoom-in">
                @auth
                  <form action="{{ route('detail-add', $products->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3">
                      Add to Cart
                    </button>
                  </form>
                @else
                  <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                    Sign in to Add
                  </a>
                @endauth
              </div>
            </div>
          </div>
        </section>
        <section class="store-description">
          <div class="container">
            <div class="row">
              <div class="col-12 col-lg-8">
                {!! $products->description !!}
              </div>
            </div>
          </div>
        </section>
    
      </div>
    </div>
@endsection

@push('addon-style')
    <style>
        .navbar {
            background-color: #fff !important; /* Atur warna sesuai kebutuhan */
            opacity: 1 !important;
        }
    </style>
@endpush

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          photos: [
            @foreach ($products->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
    </script>
@endpush
