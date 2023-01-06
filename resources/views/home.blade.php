@extends('front.layouts.app')
@section('content')
<div class="container-fluid">
        <div class="row fh5co-post-entry">
            @foreach($blogs as $blog)
            <article class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-12 animate-box">
                <figure>
                    <a href="{{route('blogs.view',$blog->id)}}"><img src="{{url('/') }}/storage/{{ $blog->image }}" alt="Image" class="img-responsive"></a>
                </figure>
                <span class="fh5co-meta"><a href="{{route('blogs.view',$blog->id)}}">{{$blog->title}}</a></span>
                <h2 class="fh5co-article-title"><a href="{{route('blogs.view',$blog->id)}}">{{$blog->desc}}</a></h2>
                <span class="fh5co-meta fh5co-date">{{$blog->publish_date}}</span>
            </article>
             <div class="clearfix visible-xs-block"></div>
           @endforeach
           
            
          
          
        </div>
    </div>
    @endsection