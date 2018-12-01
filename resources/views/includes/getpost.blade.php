@foreach($posts as $post)
	@if($post->post_type=='status')
	  @include('includes.posts')
	@elseif($post->post_type=='event')
	  @include('includes.event')
    @elseif($post->post_type=='picture post')
      @include('includes.picturepost')
	@endif
@endforeach
<div class="post-loading">
	<ul class="balls">
		<li>a</li>
		<li>a</li>
		<li>a</li>
		<li>a</li>
	</ul>
</div>