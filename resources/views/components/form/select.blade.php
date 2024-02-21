@props(['name'])
<x-form.field>
  <x-form.label name="{{$name}}"/>
  <select name="category_id">
    {{$slot}} 
  </select>
  <x-form.error name="{{$name}}"/>
</x-form.field>