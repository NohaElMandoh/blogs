@extends('front.layouts.app')
@section('content')
<div class="container-fluid">
		<div class="row fh5co-post-entry single-entry">
			<article class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
				<figure class="animate-box">
					<img src="{{url('/') }}/storage/{{ $blog->image }}" alt="Image" class="img-responsive">
				</figure>
				
				<h2 class="fh5co-article-title animate-box"><a href="{{route('blogs.view',$blog->id)}}">{{$blog->title}}</a></h2>
				<span class="fh5co-meta fh5co-date animate-box">{{$blog->publish_date}}</span>
				
				<div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-left content-article">
					

				


					<div class="row">
						
						
						<div class="col-md-12 animate-box">
							<h2>{{$blog->desc}}</h2>
							<p>{{$blog->content}}</p>
                        </div>
					</div>
					
					
				</div>
			</article>
		</div>
	</div>
<!-- ----------- -->

    @endsection