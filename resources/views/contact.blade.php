@extends('layouts.news-layout')
@section('content')
    <div class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending-tittle">
                        <h3>Contact Form</h3>
                    </div>
                </div>
            </div>
            @include('shared.contact-form')
        </div>
    </div>
@endsection