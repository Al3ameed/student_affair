
 <!-- Footer -->
 <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        all <i class="fas fa-copyright"></i> reserved to FCAIH - created by Al3ameed [Hossam Hassan]
      </div>
    </div>
  </footer>
  <!-- End of Footer -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>

{{-- load perview when image not exists  --}}
<script>

    function  corruptedImage (e) {
        image = e.target;
        image.removeEventListener('error', corruptedImage);
        image.src = "https://dummyimage.com/150x150/e8ecf8/050505.png&text=++";
    }


    document.querySelectorAll('img').forEach(img => {
        if (img.naturalWidth === 0) {
            img.addEventListener('error', corruptedImage);
            img.src = img.src;
        }
    });

</script>


