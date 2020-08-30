<div class="card card-danger">
	<div class="card-header">
		<h3 class="card-title">Главное изображение</h3>
	</div>
	<div class="card-body" style="text-align: center;">
		<div id="preview_main">
			@if(session()->has('main'))
				<div data-filename="{{ session()->get('main') }}">
					<a href="{{ asset('/uploads/main/') }}/{{ session()->get('main')}}" data-lightbox="image-2">
						<img width="50%" height="50%" src="{{ asset('/uploads/main/') }}/{{ session()->get('main') }}">
					</a>
				</div>
			@else 
				<div data-filename="{{ $product->img }}">
					<a href="{{ asset('/uploads/main/') }}/{{ $product->img }}" data-lightbox="image-2">
						<img width="50%" height="50%" src="{{ asset('/uploads/main/') }}/{{ $product->img }}">
					</a>
				</div>
			@endif
		</div>
		<div class="upload-main">
			<div class="fs-upload-target">
				<button class="btn btn-primary">
					<i class="fas fa-file-upload"></i> Загрузить
				</button>
			</div>
			<div>
				<button class="btn btn-danger" id="remove_main">
					<i class="fas fa-trash-alt"></i> Удалить
				</button>
			</div>
		</div>
	</div>
	<div class="overlay" id="loading-main" style="display: none;">
		<i class="fas fa-2x fa-sync-alt fa-spin"></i>
	</div>
	<p style="text-align: center;"><small>Рекомендуемые размеры 500x500px</small></p>
</div>
