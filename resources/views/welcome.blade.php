@extends('layouts.news-layout')
@section('content')

    <!-- Trending Area Start -->
    @include('news.top-news')
    <!-- Trending Area End -->

    <!-- Sports Trending Area -->
    <div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <h3>Top Sports News</h3>
                        </div>
                    </div>
                </div>
                <!-- Trending Tittle -->
                
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="https://placehold.co/750x400" alt="">
                                <div class="trend-top-cap">
                                    <span class="color3">{{ $latestSoccerNews[0]->category }}</span>
                                    <h2><a href="{{ route('sportsnews.show', $latestSoccerNews[0]->id) }}">{{ $latestSoccerNews[0]->title }}</a></h2>
                                </div>
                            </div>
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">
                                @for ($x = 1; $x < 4; $x++)
                                <div class="col-lg-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            <img src="https://placehold.co/240x160" alt="">
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <span class="color3">{{ $latestSoccerNews[$x]->category }}</span>
                                            <h4><a href="{{ route('sportsnews.show', $latestSoccerNews[$x]->id) }}">{{ $latestSoccerNews[$x]->title }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <!-- Right content -->
                    <div class="col-lg-4">
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <h3>Most Read</h3>
                            </div>
                        </div>
                        @foreach ($mostReadSoccerNews as $mostReadSoccerNew)
                            <div class="trand-right-single d-flex">
                                <div class="trand-right-img">
                                    <img src="https://placehold.co/120x100" alt="">
                                </div>
                                <div class="trand-right-cap">
                                    <span class="color1">{{ $mostReadSoccerNew->category }}</span>
                                    <h4><a href="{{ route('news.show', $mostReadSoccerNew->id) }}">{{ $mostReadSoccerNew->title }}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trending Area End -->

    <div class="weekly-news-area pt-50">
        <div class="container">
           <div class="weekly-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            
                            @foreach ($weeklyTopNews as $weeklyTopNew)
                                <div class="weekly-single">
                                    <div class="weekly-img">
                                        <img src="https://placehold.co/360x420" alt="">
                                    </div>
                                    <div class="weekly-caption">
                                        <span class="color1">{{ $weeklyTopNew->category }}</span>
                                        <h4><a href="{{ route('news.show', $weeklyTopNew->id) }}">{{ $weeklyTopNew->title }}</a></h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>           
    
    <!-- Technology -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container" style="border-bottom: 1px solid #ddd;padding-bottom: 60px;">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>Technology</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <!-- card one -->
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">           
                                    <div class="whats-news-caption">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="https://placehold.co/360x335" alt="">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">Night party</span>
                                                        <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="https://placehold.co/360x335" alt="">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">Night party</span>
                                                        <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="https://placehold.co/360x335" alt="">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">Night party</span>
                                                        <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="single-what-news mb-100">
                                                    <div class="what-img">
                                                        <img src="https://placehold.co/360x335" alt="">
                                                    </div>
                                                    <div class="what-cap">
                                                        <span class="color1">Night party</span>
                                                        <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
                @include('shared.social-single-article')
            </div>
        </div>
    </section>

    <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle mb-30">
                                <h3>Whats New</h3>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->                                            
                                <nav>                                                                     
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true" data-category="all">All</a>
                                        <a class="nav-item nav-link" id="nav-lifestyle-tab" data-toggle="tab" href="#nav-lifestyle" role="tab" aria-controls="nav-lifestyle" aria-selected="false" data-category="lifestyle">Lifestyle</a>
                                        <a class="nav-item nav-link" id="nav-travel-tab" data-toggle="tab" href="#nav-travel" role="tab" aria-controls="nav-travel" aria-selected="false" data-category="travel">Travel</a>
                                        <a class="nav-item nav-link" id="nav-fashion-tab" data-toggle="tab" href="#nav-fashion" role="tab" aria-controls="nav-fashion" aria-selected="false" data-category="fashion">Fashion</a>
                                        <a class="nav-item nav-link" id="nav-sports-tab" data-toggle="tab" href="#nav-sports" role="tab" aria-controls="nav-sports" aria-selected="false" data-category="sports">Sports</a>
                                        <a class="nav-item nav-link" id="nav-technology-tab" data-toggle="tab" href="#nav-technology" role="tab" aria-controls="nav-technology" aria-selected="false" data-category="technology">Technology</a>
                                    </div>
                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Nav Card -->
                            <div class="tab-content" id="nav-tabContent">
                                <div id="whats-news-list">
                                    <div id="whats-news" class="row">

                                    </div>
                                </div>
                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @section('scripts')
    <script>
        $(document).ready(function () {

            // Initial load for the "All" category
            loadCategoryContent('all');

            $('a[data-category]').click(function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                $('a[data-category]').removeClass('active');
                $(this).addClass('active');

                // Get the category value
                var category = $(this).data('category');
                
                // Load content based on category
                loadCategoryContent(category);
            });

            // Function to load category content via AJAX
            function loadCategoryContent(category) {
                $.ajax({
                    url: '/news/category/' + category,  
                    type: 'GET',
                    success: function(response) {
                        
                        populateContent(response.data);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", error);
                    }
                });
            }

            function populateContent(articles) {
                var contentHtml = ''; // This will hold the HTML content

                // Loop through the articles and generate HTML for each
                articles.forEach(function(article) {
                    contentHtml += `
                        <div class="col-lg-6 col-md-6">
                            <div class="single-what-news mb-100">
                                <div class="what-img">
                                    <img src="https://placehold.co/360x335" alt="">
                                </div>
                                <div class="what-cap">
                                    <span class="color1">${article.category}</span>
                                    <h4><a href="#">${article.title}</a></h4>
                                </div>
                            </div>
                        </div>
                    `;
                });

                // Inject the generated HTML into the content section
                $('#whats-news').html(contentHtml);
            }
        });
    </script>
    
    @endsection
@endsection