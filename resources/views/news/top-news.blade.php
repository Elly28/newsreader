<div class="trending-area fix">
    <div class="container">
        <div class="trending-main">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <h3>Top News</h3>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8">
                    <!-- Trending Top -->
                    <div class="trending-top mb-30">
                        <div class="trend-top-img">
                            <img src="https://placehold.co/750x400" alt="">
                            <div class="trend-top-cap">
                                <span>{{ $latestArticles[0]->category }}</span>
                                <h2><a href="{{ route('news.show', $latestArticles[0]->id) }}">{{ $latestArticles[0]->title }}</a></h2>
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
                                            <span class="color1">{{ $latestArticles[$x]->category }}</span>
                                            <h4><a href="{{ route('news.show', $latestArticles[$x]->id) }}">{{ $latestArticles[$x]->title }}</a></h4>
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
                    @foreach ($mostReadNews as $mostReadNew)
                        <div class="trand-right-single d-flex">
                            <div class="trand-right-img">
                                <img src="https://placehold.co/120x100" alt="">
                            </div>
                            <div class="trand-right-cap">
                                <span class="color1">{{ $mostReadNew->category }}</span>
                                <h4><a href="{{ route('news.show', $mostReadNew->id) }}">{{ $mostReadNew->title }}</a></h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>