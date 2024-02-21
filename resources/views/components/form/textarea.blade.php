@props(['name'])
<x-form.field>
  <x-form.label name="{{$name}}"/>
  <textarea name="{{$name}}" cols="30" rows="10" {{$attributes(['value' => old($name)])}}>
    {{$slot ?? old($name)}}
  </textarea>
  <x-form.error name="{{$name}}"/>
</x-form.field>