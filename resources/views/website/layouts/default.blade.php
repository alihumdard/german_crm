<!DOCTYPE html>
<!-- here basic three files header footer and content and head contain link and scripts contain js scripts-->
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="MEWTON Digital">
    <title>@yield('title' , 'MEWTON Digital')</title>
    @include('website.includes.head')

</head>

<body>
    @include('website.includes.header')
    @yield('content')
    @include('website.includes.footer')
    @include('website.includes.script')
    @stack('scripts')
</body>
<script>
'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'},{'ap':'cpsh-oh'},{'server':'sxb1plzcpnl503794'},{'dcenter':'sxb1'},{'cp_id':'9634510'},{'cp_cl':'8'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script>
<script src='https://img1.wsimg.com/traffic-assets/js/tccl.min.js'></script>
</html>