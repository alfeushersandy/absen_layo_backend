<div class="mb-3">
    <div class="form-label">{{ $title }}</div>
    <select class="form-control selectpicker @error($name) is-invalid @enderror" data-live-search="true" name="{{ $name }}">
        {{ $slot }}
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>