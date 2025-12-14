document.addEventListener("DOMContentLoaded", function () {

    // 1. Hiệu ứng Scroll Reveal (Hiện dần khi cuộn)
    const reveals = document.querySelectorAll(".reveal");

    const revealOnScroll = () => {
        const windowHeight = window.innerHeight;
        const elementVisible = 100;

        reveals.forEach((reveal) => {
            const elementTop = reveal.getBoundingClientRect().top;
            if (elementTop < windowHeight - elementVisible) {
                reveal.classList.add("active");
            }
        });
    };

    window.addEventListener("scroll", revealOnScroll);
    // Gọi 1 lần đầu tiên để load những cái đang thấy
    revealOnScroll();

    // 2. Hiệu ứng chạy số (Counter Animation) cho phần thống kê
    const counters = document.querySelectorAll(".counter-value");
    let hasCounted = false; // Chỉ chạy 1 lần

    const startCounters = () => {
        counters.forEach((counter) => {
            const target = +counter.getAttribute("data-target"); // Lấy số đích
            const speed = 200; // Tốc độ
            const increment = target / speed;

            const updateCount = () => {
                const count = +counter.innerText;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target >= 1000 ? (target / 1000).toFixed(0) + "k+" : target + "+";
                }
            };
            updateCount();
        });
    };

    // Sử dụng IntersectionObserver để biết khi nào cuộn tới phần Stats thì mới chạy số
    const statsSection = document.querySelector(".stats-section");
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !hasCounted) {
                startCounters();
                hasCounted = true;
            }
        });
        observer.observe(statsSection);
    }
});