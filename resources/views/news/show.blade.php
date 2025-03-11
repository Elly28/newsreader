@extends('layouts.news-layout')
@section('content')
    <!-- About US Start -->
    <div class="about-area">
        <div class="container">
                <!-- Hot Aimated News Tittle-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90">
                            <div class="about-img">
                                <img src="https://placehold.co/750x400" alt="">
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3>{{ $article->title }}</h3>
                            </div>
                            <div class="about-prea">
                                <p>{{ $article->content }}</p>
                            </div> 
                            
                            <div class="social-share pt-30">
                                <div class="section-tittle">
                                    <h3 class="mr-20">Share:</h3>
                                    <ul>
                                        <li><a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a></li>
                                        <li><a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @include('shared.contact-form')
                    </div>

                    @include('shared.social-single-article')
               </div>
        </div>
    </div>
    <!-- About US End -->
@endsection