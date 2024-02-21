@props(['name'])
@error($name)
<p class="text-red tex-xs">{{$message}}</p>
@enderror