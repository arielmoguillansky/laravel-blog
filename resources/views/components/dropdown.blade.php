@props(['trigger'])
<div x-data="{show:false}" @click.away="show=false" class="relative">
  <div @click="show = !show">
    {{$trigger}}
  </div>
  <div x-show="show" class="py-2 absolute w-full bg-gray-100 mt-2 rounded-xl" style="display:none">
    {{$slot}}
  </div>
</div>