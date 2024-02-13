@props(['color'=>false, 'size'=>"md"])
@php
    if($color){
        $text = contrastColor(cssToHex($color)); 
    } else {
        $color = "bg-gray-100";
        $text = contrastColor(cssToHex($color));
    }
    switch ($size) {
        case 'sm':
            $sizeClasses = "px-2 py-1 text-sm";
            break;
            
        case 'xs':
            $sizeClasses = "px-2 py-1 text-xs";
            break;
        
        default:
            $sizeClasses = "px-3 py-2 text-sm";
            break;
    }
@endphp
    <div {{ $attributes->merge(['class'=>'h-full inline-block my-auto text-center rounded-sm hover:bg-opacity-75 hover:shadow-inner font-bold dark:border dark:border-'.$text.' text-'.$text.' '.$color.' '.$sizeClasses]) }} role="button"> 
        {{ $slot }}
    </div>
