@props([
    'image',
    'alt' => '',
    'class' => '',
    'priority' => false,
])

<div class="device-phone {{ $class }}">
    <div class="device-phone__bezel">
        <div class="device-phone__screen">
            <img 
                src="{{ asset($image) }}" 
                alt="{{ $alt }}" 
                class="device-phone__img"
                loading="{{ $priority ? 'eager' : 'lazy' }}"
                decoding="async"
            />
        </div>
    </div>
</div>
