<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body
class="min-h-screen
bg-gradient-to-br
from-slate-100
via-blue-50
to-slate-200
overflow-hidden
flex
items-center
justify-center
relative">

<div
class="absolute
w-96
h-96
rounded-full
bg-blue-400/20
blur-3xl
-top-24
-left-24">
</div>

<div
class="absolute
w-96
h-96
rounded-full
bg-cyan-300/20
blur-3xl
bottom-0
right-0">
</div>

<div
class="absolute
w-72
h-72
rounded-full
bg-indigo-400/20
blur-3xl
top-1/2
left-1/2
-translate-x-1/2
-translate-y-1/2">
</div>

{{ $slot }}

</body>

</html>