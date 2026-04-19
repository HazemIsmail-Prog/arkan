document.addEventListener('alpine:init', () => {
    Alpine.data('dashboardComponent', (payload = {}) => ({
        ...payload,
        slideIndex: 0,

        ringRadius: 52,
        
        init() {
            this.ringCirc = 2 * Math.PI * this.ringRadius;
            this.workDashOffset = this.ringCirc * (1 - this.workProgressPct / 100);
            this.timelineDashOffset = this.ringCirc * (1 - this.timelineProgressPct / 100);
        },

        galleryNext() {
            const imgs = this.galleryImages ?? [];
            if (imgs.length === 0) {
                return;
            }
            this.slideIndex = (this.slideIndex + 1) % imgs.length;
        },

        galleryPrev() {
            const imgs = this.galleryImages ?? [];
            if (imgs.length === 0) {
                return;
            }
            this.slideIndex = (this.slideIndex - 1 + imgs.length) % imgs.length;
        },

        galleryGo(src, i) {
            this.slideIndex = i;
        },

        galleryPhotoAlt(i) {
            return `${this.photoAltPrefix} ${i + 1}`.trim();
        },

        gallerySlideAria(i) {
            return `${this.goToSlidePrefix} ${i + 1}`.trim();
        },
    }));
});
