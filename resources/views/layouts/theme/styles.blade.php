<!-- [Favicon] icon -->
<link rel="icon" href="{{ asset('template/images/favicon.svg') }}" type="image/x-icon" />
<!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{ asset('template/fonts/tabler-icons.min.css') }}" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{ asset('template/fonts/material.css') }}" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{ asset('template/css/style.css') }}" id="main-style-link" />
<link rel="stylesheet" href="{{ asset('template/css/style-preset.css') }}" id="preset-style-link" />
<!-- [My Styles Own] -->
{{-- <link rel="stylesheet" href="{{ asset('own/styles.css') }}" id="preset-style-link" /> --}}
<!-- [Bootstrap Icons] -->
<link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}" id="preset-style-link" />

<style>
    .loader {
  width: 100%;
  height: 12px;
  display: inline-block;
  background-color: #FFF;
  background-image: linear-gradient(45deg, rgba(102, 16, 242, 0.25) 25%, transparent 25%, transparent 50%, rgba(102, 16, 242, 0.25) 50%, rgba(102, 16, 242, 0.25) 75%, transparent 75%, transparent);
  font-size: 30px;
  background-size: 1em 1em;
  box-sizing: border-box;
  animation: barStripe 1s linear infinite;
}

@keyframes barStripe {
  0% {
    background-position: 1em 0;
  }
  100% {
    background-position: 0 0;
  }
}
</style>

@livewireStyles