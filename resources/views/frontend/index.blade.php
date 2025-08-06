@include('frontend.partials.header')
@include('frontend.partials.navbar')
@include('frontend.components.hero')
@include('frontend.components.about')
@include('frontend.components.features')
@include('frontend.components.work')
@include('frontend.components.services')
@include('frontend.components.track')
@include('frontend.components.contact')
<script>
document.addEventListener("DOMContentLoaded", function() {
    let slug = @json($slug ?? null);
    if (slug) {
        let target = document.getElementById(slug);
        if (target) {
            target.scrollIntoView({ behavior: "smooth" });
        }
    }
});
</script>
@include('frontend.partials.footer')