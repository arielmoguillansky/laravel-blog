@props(['name', 'type'=>'text'])
<x-form.field>
  <x-form.label name="{{$name}}"/>
  <input class="border border-gray-300" type="{{$type}}" name="{{$name}}" {{$attributes(['value' => old($name)])}} >
  <x-form.error name="{{$name}}"/>
</x-form.field>