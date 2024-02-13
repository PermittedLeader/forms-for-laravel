@props(['icon','label'])
<i {{ $attributes->merge(['class'=>$icon,'title'=>$label]) }} aria-hidden="true"></i>
<span class="sr-only">{{ $label }}</span>