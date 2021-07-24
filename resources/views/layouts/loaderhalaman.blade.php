<!-- loader halaman -->
<div id="loading-image" class="pembungkus-loader min-h-screen fixed w-full z-10 flex flex-col space-y-3 justify-center items-center bg-gray-100 opacity-80">
    <div class="loader bg-white p-5 rounded-full flex space-x-3">
        <div class="w-5 h-5 bg-blue-400 rounded-full animate-bounce"></div>
        <div class="w-5 h-5 bg-red-400 rounded-full animate-bounce"></div>
        <div class="w-5 h-5 bg-blue-400 rounded-full animate-bounce"></div>
    </div>
    <span class="animate-pulse">Loading.. </span>
</div>
<script>
    const pemb = document.querySelector('.pembungkus-loader');
    window.onload = function(event) {
      pemb.remove();
    };


    // $(function () {
    //     // page is loaded, it is safe to hide loading animation
    //     $('#loading-bg').hide();
    //     $('#loading-image').hide();

    //     $(window).on('beforeunload', function () {
    //         // user has triggered a navigation, show the loading animation
    //         $('#loading-bg').show();
    //         $('#loading-image').show();
    //     });
    // });
</script>
<!-- loader halaman -->
