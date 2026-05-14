<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">🔑 SEO Keywords</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Keywords <small class="text-muted">(separate with commas)</small></label>
            <input type="text" 
                   name="keywords" 
                   class="form-control @error('keywords') is-invalid @enderror" 
                   value="{{ old('keywords', isset($post) ? $post->keywords->pluck('keyword')->implode(', ') : '') }}"
                   placeholder="laravel, php, programming, web development">
            @error('keywords')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>