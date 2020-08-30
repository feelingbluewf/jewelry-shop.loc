<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">Изображения в галерее</h3>
	</div>
	<div class="card-body">
		<div class="row" id="preview_gallery" style="text-align: left;">
			@if(session()->has('gallery'))
			@foreach(session()->get('gallery') as $key => $image)
			<div class="col-sm-3 img" data-filename="{{ $image }}" data-key="{{ $key }}">
				<span class="close_pic" onclick="removeImage(this)">×</span>
				<a href="{{ asset('/uploads/gallery/') }}/{{ $image }}" data-lightbox="image-1">
					<img class="img-fluid" src="{{ asset('/uploads/gallery/') }}/{{ $image }}">
				</a>
			</div>
			@endforeach
			@endif
		</div>
		<div class="upload-gallery">
			<div class="fs-upload-target">
				<button class="btn btn-success">
					<i class="fas fa-file-upload"></i> Загрузить
				</button>
			</div>
		</div>
	</div>
	<div class="overlay" id="loading-gallery" style="display: none;">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<p style="text-align: center;"><small>Рекомендуемые размеры 500x500px</small></p>
</div>