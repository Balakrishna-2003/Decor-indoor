document.addEventListener("DOMContentLoaded", function () {

    const sections = document.querySelectorAll(
        ".di-feature-strip, " +
        ".di-welcome-section, " +
        ".di-services, " +
        ".di-impact-section, " +
        ".di-commercial-section, " +
        ".di-process-section, " +
        ".di-featured-projects, " +
        ".di-testimonials-section, " +
        ".di-cta-section," +
        ".di-footer"
    );

    document.documentElement.classList.add("di-scroll-live-enabled");

    if (!sections.length) {
        return;
    }

    const observer = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {

                    entry.target.classList.add("di-scroll-visible");

                    observer.unobserve(entry.target);
                }

            });

        },
        {
            threshold: 0.14,
            rootMargin: "0px 0px -10% 0px"
        }
    );

    sections.forEach(function (section) {
        observer.observe(section);
    });

});