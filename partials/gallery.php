<?php
/* =============================================
   partials/gallery.php
   Floating carousel FAB + lightbox gallery.

   Usage before </body>:
     $galleryImages   = [ ['src'=>'...','caption'=>'...'], ... ];
     $carouselImages  = [ 'https://...?w=120&h=120&fit=crop', ... ];
     require __DIR__ . "/../partials/gallery.php";

   $galleryImages   — full-res images for lightbox
   $carouselImages  — small square crops for FAB carousel
                      (3–5 images recommended)
   If neither is set, nothing renders.
   ============================================= */

if (empty($galleryImages) && empty($carouselImages)) return;
if (!is_array($galleryImages ?? null))  $galleryImages  = [];
if (!is_array($carouselImages ?? null)) $carouselImages = [];

/* Sanitise gallery images */
$safeGallery = array_map(function ($img) {
    return [
        'src'     => htmlspecialchars($img['src']     ?? '', ENT_QUOTES),
        'caption' => htmlspecialchars($img['caption'] ?? '', ENT_QUOTES),
    ];
}, $galleryImages);

/* Sanitise carousel URLs */
$safeCarousel = array_map(function ($url) {
    return htmlspecialchars($url, ENT_QUOTES);
}, $carouselImages);

$jsonGallery  = json_encode($safeGallery,  JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
$jsonCarousel = json_encode($safeCarousel, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<script>
window.GALLERY_IMAGES   = <?= $jsonGallery ?>;
window.CAROUSEL_IMAGES  = <?= $jsonCarousel ?>;
</script>